<?php
namespace App\Http\Controllers\Backend\Dashboard;

use App\Enums\Modules\ModuleType;
use App\Enums\Posts\PostStatusType;
use App\Enums\Users\UserType;
use App\Http\Controllers\BackendController;
use App\Repositories\Post\PostRepository;
use App\Repositories\Roles\PermissionRepository;
use App\Repositories\Users\UserRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class DashboardController extends BackendController
{
    protected $data = [];
    protected $permissionRepository,$postRepository,$userRepository;
    public function __construct(
        PermissionRepository $permissionRepository,
        PostRepository $postRepository,
        UserRepository $userRepository
    ){
        parent::__construct();
        $this->permissionRepository = $permissionRepository;
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {

//        $user =  Auth::guard('backend')->user();
//        $user->syncRoles(['tai-khoan-ceo', 'xx']);
//        $role = $this->permissionRepository->getByID(1);
//        $p = $role->children()->get();
//        dd($p);
        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
//        $co = Cart::content();
//        dd($co);
        //$user = Auth::guard('backend')->user();
        //$user = Auth()->guard('backend')->user();

        // Hồ sơ
       $this->data['pending'] = $this->postRepository->getTotal(['status'=>[PostStatusType::Pending],'module_id'=>[ModuleType::Document]]);
       $this->data['success'] = $this->postRepository->getTotal(['status'=>[PostStatusType::Success],'module_id'=>[ModuleType::Document]]);
       $this->data['confirmation'] = $this->postRepository->getTotal(['status'=>[PostStatusType::Order_Confirmation],'module_id'=>[ModuleType::Document]]);
       $this->data['payment'] = $this->postRepository->getTotal(['status'=>[PostStatusType::Payment_Order],'module_id'=>[ModuleType::Document]]);

       //Khách hàng
        $this->data['sevenDaysUser'] = $this->userRepository->getTotal(['sevenDays'=>1]);
        $this->data['activeUser'] = $this->userRepository->getTotal(['status'=>[UserType::Approved]]);
        $this->data['deactivatedUser'] = $this->userRepository->getTotal(['status'=>[UserType::Deactivated]]);
        $this->data['todayUser'] = $this->userRepository->getTotal(['today'=>1]);


        $this->data['title'] = 'Dashboard';
        $this->data['title'] = 'Dashboard';
        return view('components.backend.dashboard.index', $this->data);
    }
}
