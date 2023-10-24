<?php

namespace App\Http\Controllers\Backend\Post;

use App\Enums\Modules\ModuleType;
use App\Enums\Posts\PostStatusType;
use App\Enums\Roles\RoleType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Category\CategoryRequest;
use App\Http\Requests\Backend\Post\NewsCreateRequest;
use App\Models\Images\Image;
use App\Models\Post\Comment;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Images\ImageRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as ImageIntervention;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DocumentController extends BackendController
{

    private $data = [];
    protected $postRepository, $categoryRepository,$userRepository,$imageRepository;

    public function __construct(
        PostRepository $postRepository,
        UserRepository $userRepository,
        ImageRepository $imageRepository,
        CategoryRepository $categoryRepository)
    {

        parent::__construct();
        $this->data['title'] = 'News';
        View::share('title', 'Tin tức');

        $this->data['status'] = [
            PostStatusType::Pending => 'Chờ duyệt',
            PostStatusType::Payment_Order => 'Đề nghị thanh toán',
            PostStatusType::Order_Confirmation => 'Xác nhận đã thanh toán',
            PostStatusType::Success => 'Đã duyệt',
        ];

        $this->data['statusCategory'] = [
            PostStatusType::Approved => 'Đang hoạt động',
            PostStatusType::Deactivated => 'Ngừng hoạt động',
        ];

        $this->data['options'] = [
            PostStatusType::New => 'Mới',
            PostStatusType::Home => 'Xuất hiện trang chủ',
        ];
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
        $this->imageRepository = $imageRepository;
    }


    public function index( Request $request )
    {
        $params = $request->all();
        $user = Auth::guard('backend')->user();
        $roles = $user->getRoleNames()->toArray();
        $flag = false;
        if ( count($roles) > 0 ) {
            if ( in_array(RoleType::manager, $roles) ||
                in_array(RoleType::employee_main, $roles) ||
                in_array(RoleType::employee_sub, $roles) ) {
                $flag = true;
            }
        }

        // Nếu là trưởng phòng, nhân viên chính, nhân viên phụ
        if ( $flag ) {
            $lsCustomer = $user->managementUser()->pluck('user_id');
            $params['user_id'] = count($lsCustomer) > 0 ? $lsCustomer->toArray() :  [-1];
        }

        $params['module_id'] = [ModuleType::Document] ;
        $post = $this->postRepository->getAll($params, 20);

        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('backend.document.index') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        return view('components.backend.document.index', $this->data);
    }

    public function create()
    {
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Document]]);
        $this->data['isEdit'] = 0;
        $this->data['posts']  = [];
        $this->data['users'] = $this->userRepository->getAll(['status'=>[1]]);
        return view('components.backend.document.create', $this->data);
    }

    public function store( NewsCreateRequest $request )
    {
        $params = $request->all();
        $params['category_id'] = $params['category_id'] ?? 0;
        $params['module_id'] = ModuleType::Document;
        if(!empty($params['created_at'])){
            $created_at = $params['created_at'] .' '.date('H:i:s');
            $params['created_at'] = date('Y-m-d H:i:s',strtotime($created_at));
        }

        if(!empty($params['date_of_filing'])){
            $date_of_filing = $params['date_of_filing'] .' '.date('H:i:s');
            $params['date_of_filing'] = date('Y-m-d H:i:s',strtotime($date_of_filing));
        }

        if(!empty($params['received_date'])){
            $received_date = $params['received_date'] .' '.date('H:i:s');
            $params['received_date'] = date('Y-m-d H:i:s',strtotime($received_date));
        }

        $post = $this->postRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.document.index')->with('error', 'Server đang bận không thể tạo');
        }

        if ( $request->hasfile('image') ) {

            $date = date('Y/m/d');
            $request->file('image')->store('avatar/' . $date);
            $aImage = $request->file('image')->hashName();
            $pathOld = public_path('storage/avatar/' . $date . '/' . $aImage);
            $fileNewSize = public_path('storage/avatar/' . $date . '/thumb_50x50_' . $aImage);

            $img = ImageIntervention::make($pathOld);
            $img->fit(50, 50, function ( $constraint ) {
                $constraint->upsize();
            });

            $fileNew = public_path('storage/avatar/' . $date . '/thumb_' . $aImage);
            $img->heighten(150, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($fileNew);

            $img->save($fileNewSize);
            $params['logo'] = $date . '/' . $aImage;
        }


        if ( $request->hasfile('files') ) {
            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $path = $file->store('products/' . $date);
                $aImage = $file->hashName();
                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->filename = $file->getClientOriginalName();
                $photo->is_default = ( $key == $n - 1 ) ? 1 : 0;
                $post->image()->save($photo);

            }
        }
        return redirect()->route('backend.document.index')->with('success', 'Đã tạo tài thành công');
    }

    public function edit( $id )
    {
        $post = $this->postRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.document.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        $this->data['users'] = $this->userRepository->getAll(['status'=>[1]]);
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Document]]);
        return view('components.backend.document.create', $this->data);
    }

    public function update( NewsCreateRequest $request, $id )
    {
        $params = $request->all();
        $params['status'] = $params['status'] ?? 0;
        $params['category_id'] = $params['category_id'] ?? 0;
        $post = $this->postRepository->getByID($id);
        if ( !$post ) {
            return redirect()->route('backend.document.index')->with('error', 'Không tìm thấy dữ liệu');
        }

        if(!empty($params['created_at'])){
            $created_at = $params['created_at'].' '.date('H:i:s',strtotime($post->created_at));
            $params['created_at'] = date('Y-m-d H:i:s',strtotime($created_at));
        }

        if(!empty($params['date_of_filing'])){
            $date_of_filing = $params['date_of_filing'].' '.date('H:i:s',strtotime($post->date_of_filing));
            $params['date_of_filing'] = date('Y-m-d H:i:s',strtotime($date_of_filing));
        }

        if(!empty($params['received_date'])){
            $received_date = $params['received_date'].' '.date('H:i:s',strtotime($post->received_date));
            $params['received_date'] = date('Y-m-d H:i:s',strtotime($received_date));
        }

        if ( $request->hasfile('image') ) {

            if($post->logo) {
                @unlink(public_path('storage/avatar/' . $post->logo));
            }

            $date = date('Y/m/d');
            $request->file('image')->store('avatar/' . $date);
            $aImage = $request->file('image')->hashName();
            $pathOld = public_path('storage/avatar/' . $date . '/' . $aImage);
            $fileNewSize = public_path('storage/avatar/' . $date . '/thumb_50x50_' . $aImage);
            $img = ImageIntervention::make($pathOld);
            $img->fit(50, 50, function ( $constraint ) {
                $constraint->upsize();
            });

            $fileNew = public_path('storage/avatar/' . $date . '/thumb_' . $aImage);
            $img->heighten(150, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($fileNew);

            $img->save($fileNewSize);
            $params['logo'] = $date . '/' . $aImage;
        }

        $post->update($params);

        if ( $request->hasfile('files') ) {

            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $file->store('products/' . $date);
                $aImage = $file->hashName();

                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->filename = $file->getClientOriginalName();
                $photo->is_default = ( $key == $n - 1 ) ? 1 : 0;
                $post->image()->save($photo);

            }
        }

        return redirect()->route('backend.document.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy( $id )
    {
        $post = $this->postRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $images = $post->image()->get();
        if ( count($images) > 0 ) {
            foreach ( $images as $item ) {
                $deleteFile = $item->url ?? null;
                if ( !empty($deleteFile) ) {
                    $fileUnlink = Str::of('/' . $deleteFile)->basename();
                    @unlink(public_path('storage/products/' . $deleteFile));
                    @unlink(public_path('storage/products/' . str_replace($fileUnlink, 'thumb_' . $fileUnlink, $deleteFile)));
                    @unlink(public_path('storage/products/' . str_replace($fileUnlink, 'thumb_50x50_' . $fileUnlink, $deleteFile)));
                }
                $item->delete();
            }
        }

        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }

    public function category( Request $request )
    {
        $params = $request->only(['username', 'password']);
        $post = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Document]], 20);
        $this->data['title'] = 'News';
        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('backend.document.category') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        return view('components.backend.document.category', $this->data);
    }

    public function createCategory()
    {
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Document]]);
        $this->data['isEdit'] = 0;
        $this->data['posts'] = [];
        return view('components.backend.document.category-create', $this->data);
    }

    public function storeCategory( CategoryRequest $request )
    {
        $params = $request->all();
        $params['status'] = 1;
        $params['module_id'] = ModuleType::Document;
        $post = $this->categoryRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.document.category')->with('error', 'Server đang bận không thể tạo');
        }

        return redirect()->route('backend.document.category')->with('success', 'Đã tạo tài thành công');
    }

    public function updateCategory( CategoryRequest $request, $id )
    {
        $params = $request->all();
        $params['status'] = 1;
        $post = $this->categoryRepository->getByID($id);
        if ( !$post ) {
            return redirect()->route('backend.document.category')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        return redirect()->route('backend.document.category')->with('success', 'Đã cập nhật thành công');
    }

    public function editCategory( $id )
    {
        $post = $this->categoryRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.document.category')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Document]]);
        return view('components.backend.document.category-create', $this->data);
    }

    public function destroyCategory( $id )
    {
        $category = $this->categoryRepository->getByID($id);
        if ( !$category ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }
        $category->posts()->delete();
        $category->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }

    public function download($id)
    {
        $image = $this->imageRepository->getByID($id);
        if(!$image) {
            return self::errors();
        }

        $filePath = public_path('storage/products/' . $image->url);
        $headers = [
            'Content-Type: application/pdf',
            'Content-Type: image/png',
            'Content-Type: image/jpeg',
            'Content-Type: application/vnd.msword',
            'Content-Type: application/vnd.ms-excel',
            'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Type: application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'Content-Type: application/x-rar-compressed',
            'Content-Type: application/octet-stream',
            'Content-Type: application/zip',
            'Content-Type: application/x-zip-compressed',
            'Content-Type: multipart/x-zip',
            'Content-Type: application/x-rar',
            'Content-Type: application/vnd.rar',
        ];
        // header("Content-Type: image/png");

        if (!file_exists($filePath)){
            return self::errors();
        }

        $fileName = $image->filename;
        return response()->download($filePath, $fileName, $headers);
    }

    public function show(Request $request,$id) {
        $post = $this->postRepository->getByID($id);
        $this->data['post'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.document.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['user'] = [];
        $user_id = $post->user_id ?? 0;
        $user = $this->userRepository->getByID($user_id);
        if( $user ){
            $this->data['user'] = $user;
        }
        return view('components.backend.document.show', $this->data);
    }

    public function deleteImage($id)
    {
        $image = $this->imageRepository->getByID($id);
        if(!$image){
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        if($image->url) {
            @unlink(public_path('storage/products/' . $image->url));
        }
        $image->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }

    public function uploadImage(Request $request)
    {
        $post_id = $request->post_id ?? 0;
        $post = $this->postRepository->getByID($post_id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm dữ liệu');
        }

        $comment = new Comment();
        $comment->user_id = 0;
        $comment->parent_id = 0;
        $comment->message = $request->message;
        $comment->created_at = date('Y-m-d H:i:s');
        $commentInfo = $post->comments()->save($comment);

        if ($request->isMethod('post'))
        {
            if($request->hasFile('customFileInput'))
            {
                $date = date('Y/m/d');
                foreach ( $request->file('customFileInput') as $key => $file ) {
                    $file->store('products/' . $date);
                    $aImage = $file->hashName();

                    $photo = new Image();
                    $photo->url = $date . '/' . $aImage;
                    $photo->filename = $file->getClientOriginalName();
                    $photo->is_default = 0;
                    $photo->comment_id = $commentInfo->id;
                    $post->image()->save($photo);

                }
            }
        }

        return ResponseHelper::success('Đã xóa thành công');
    }

    public function changeStatus(Request $request,$id){
        $post = $this->postRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm dữ liệu');
        }
        $post->status = $request->status;
        $post->save();
        return ResponseHelper::success('Đã cập nhật thành công');
    }
}
