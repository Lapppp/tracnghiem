<?php

namespace App\Http\Controllers\Frontend\User;

use App\Enums\Orders\OrderMethodPaymentType;
use App\Enums\Orders\OrderStatusType;
use App\Helpers\ResponseHelper;
use App\Helpers\StringHelper;
use App\Http\Requests\Frontend\User\StoreUserForgotPasswordRequest;
use App\Http\Requests\Frontend\User\StoreUserResetPasswordRequest;
use App\Http\Requests\Frontend\User\UpdateUserRequest;
use App\Jobs\SendEmailJob;
use App\Repositories\Orders\OrderRepository;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Products\ProductsFavouriteRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

//use Auth;

use App\Models\Images\Image;
use App\Enums\Roles\RoleType;
use App\Helpers\PaginationHelper;
use App\Enums\Users\UserGenderType;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Users\UserRepository;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageIntervention;

class xUserController extends FrontendController
{
    //
    private $data = [];
    private $userRepository, $orderRepository, $productRepository, $productsFavouriteRepository;

    public function __construct(
        UserRepository $userRepository,
        OrderRepository $orderRepository,
        ProductRepository $productRepository,
        ProductsFavouriteRepository $productsFavouriteRepository
    ) {
        $this->data['title'] = 'User';
        parent::__construct();
        $this->data['genders'] = [
            UserGenderType::Male => 'Nam',
            UserGenderType::Female => 'Nữ',
        ];
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->productsFavouriteRepository = $productsFavouriteRepository;
        $this->data['status'] = OrderStatusType::All;
        $this->data['paymentMethod'] = OrderMethodPaymentType::All;
    }

    public function index(Request $request)
    {
        $this->data['user'] = Auth::guard('web')->user();
        if ( !$this->data['user'] ) {
            return redirect()->route('frontend.home.index')->with('success', 'Vui lòng đăng nhập.');
        }
        return view('components.frontend.users.index', $this->data);

        // $details=[
        //     "email"=>"johnpie99@gmail.com",
        //     "title"=>'title',
        //     "body"=>'body'
        // ];

        // dispatch(new SendEmailJob($details));
        // echo 1;
        // exit;
    }

    public function order(Request $request)
    {
        $params = $request->all();
        $this->data['user'] = Auth::guard('web')->user();
        if ( !$this->data['user'] ) {
            return redirect()->route('frontend.home.index')->with('success', 'Vui lòng đăng nhập.');
        }

        $params['user_id'] = [$this->data['user']->id];
        $orders = $this->orderRepository->getAll($params);
        $total = !empty($orders->total()) ? $orders->total() : 0;
        $perPage = !empty($orders->perPage()) ? $orders->perPage() : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = route('frontend.users.orders').'?'.Arr::query($params);
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);
        $this->data['orders'] = $orders;

        return view('components.frontend.users.order', $this->data);
    }

    public function update(UpdateUserRequest $request)
    {

        $user = Auth::guard('web')->user();
        $input = $request->only(['name', 'phone', 'email', 'address']);
        if ( !$user ) {
            return redirect()->route('frontend.home.index')->with('success', 'Vui lòng đăng nhập.');
        }

        $update = [
            'name' => strip_tags($request->input('name')),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => strip_tags($request->input('address'))
        ];
        $user->update($update);

        if ( $request->hasfile('voteImage') ) {
            //$path = $request->file('voteImage')->store('images');

            $images = $user->image()->get();
            if ( count($images) > 0 ) {
                foreach ( $images as $item ) {
                    $deleteFile = $item->url ?? null;
                    if ( !empty($deleteFile) ) {
                        $fileUnlink = Str::of('/'.$deleteFile)->basename();
                        @unlink(public_path('storage/avatar/'.$deleteFile));
                        @unlink(public_path('storage/avatar/'.str_replace($fileUnlink, 'thumb_50x50_'.$fileUnlink,
                                $deleteFile)));
                    }
                    $item->delete();
                }
            }

            $date = date('Y/m/d');
            $request->file('voteImage')->store('avatar/'.$date);
            $aImage = $request->file('voteImage')->hashName();
            $pathOld = public_path('storage/avatar/'.$date.'/'.$aImage);
            $fileNewSize = public_path('storage/avatar/'.$date.'/thumb_50x50_'.$aImage);
            $img = ImageIntervention::make($pathOld);
            $img->fit(50, 50, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($fileNewSize);

            $photo = new Image();
            $photo->url = $date.'/'.$aImage;
            $photo->is_default = 1;
            $user->image()->save($photo);
        }

        return ResponseHelper::success('Thành công');
    }

    public function favorite(Request $request)
    {

        $params = $request->all();
        $user = Auth::guard('web')->user();
        if ( !$user ) {
            return redirect()->route('frontend.home.index')->with('success', 'Vui lòng đăng nhập.');
        }

        $favorite = [];
        $this->data['pager'] = '';
        if ( $user->productsFavourite()->count() > 0 ) {
            $ids = $user->productsFavourite()->pluck('product_id')->toArray();
            $params['ids'] = $ids;
            $favorite = $this->productRepository->getAll($params);
            $total = !empty($favorite->total()) ? $favorite->total() : 0;
            $perPage = !empty($favorite->perPage()) ? $favorite->perPage() : 20;
            $page = !empty($request->page) ? $request->page : 1;
            $url = route('frontend.users.favorite').'?'.Arr::query($params);
            $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);
        }
        $this->data['favorite'] = $favorite;
        return view('components.frontend.users.favorite', $this->data);
    }

    public function addFavorite(Request $request)
    {
        $user = Auth::guard('web')->user();
        if ( !$user ) {
            return ResponseHelper::error('Thành công', [], 403);
        }

        $product_id = $request->product_id ?? 0;
        $favorite = $this->productsFavouriteRepository->checkUserFavourite($product_id, $user->id);
        $product = $this->productRepository->getById($product_id);
        if ( !$favorite && $product ) {
            $this->productsFavouriteRepository->create([
                'product_id' => $product_id,
                'user_id' => $user->id,
            ]);
        }

        $data = [
            'total' => $user->productsFavourite()->count()
        ];

        return ResponseHelper::success('Thành công', $data, 200);
    }

    public function removeFavorite(Request $request)
    {
        $user = Auth::guard('web')->user();
        if ( !$user ) {
            return ResponseHelper::error('Thành công', [], 403);
        }

        $product_id = $request->product_id ?? 0;
        $favorite = $this->productsFavouriteRepository->checkUserFavourite($product_id, $user->id);
        $product = $this->productRepository->getById($product_id);
        if ( $favorite && $product ) {
            $favorite->delete();
        }

        $data = [
            'total' => $user->productsFavourite()->count(),
            'product_id' => $product_id,
        ];

        return ResponseHelper::success('Thành công', $data, 200);
    }

    public function forgotPassword(Request $request)
    {
        return View('components.frontend.users.forget-password', $this->data);
    }

    public function storeForgotPassword(StoreUserForgotPasswordRequest $request)
    {

        $email = $request->email ?? '';
        $user = $this->userRepository->getEmail($email);
        $reset_password = StringHelper::generatePassword(30);
        $details = [
            'title' => 'Thay đổi mật khẩu từ  https://kenjivietnam.vn',
            'password' => $reset_password,
            'token' => base64_encode($user->id),
            'full_name' => $user->name ?? $user->phone ?? ''
        ];

        Mail::to($email)->send(new \App\Mail\MyTestMail($details));
        if ( $user ) {
            $user->update(['is_change_password' => 1,'reset_password'=>$reset_password]);
        }
        return ResponseHelper::success('Thành công', []);
    }

    public function resetPassword(Request $request)
    {
        $id = base64_decode($request->token);
        $user = $this->userRepository->getByID($id);
        if ( !$user ) {
            return redirect()->route('frontend.home.index')->with('success', 'Tài khoản không tồn tại');
        }

        if(empty($user->is_change_password)){
            return redirect()->route('frontend.home.index')->with('success', 'Mật khẩu này đã được đổi trước đó.');
        }

        $this->data['user'] = $user;
        return View('components.frontend.users.reset-password', $this->data);
    }

    /**
     * @param  StoreUserResetPasswordRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeResetPassword(StoreUserResetPasswordRequest $request)
    {
        $id = $request->user_id ?? 0;
        $user = $this->userRepository->getByID($id);
        $user->update(['password' => Hash::make($request->password),'is_change_password'=>0,'reset_password'=>'']);
        return ResponseHelper::success('Thành công', []);
    }
}
