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

class UserController extends FrontendController
{
    //
    private $data = [];
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->data['title'] = 'User';
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params = $request->only(['page']);
        $this->data['user'] = Auth::guard('web')->user();
        if ( !$this->data['user'] ) {
            return redirect()->route('ffrontend.auth.login')->with('success', 'Vui lòng đăng nhập.');
        }
        $posts = $this->data['user']->tests()->paginate(18);
        $total = !empty($posts->total()) ? $posts->total() : 0;
        $perPage = !empty($posts->perPage()) ? $posts->perPage() : 18;
        $this->data['posts'] = $posts;
        $page = !empty($request->page) ? $request->page : 1;
        $url = route('frontend.users.index').'?'.Arr::query($params);
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);

        return view('components.frontend.users.index', $this->data);
    }

}
