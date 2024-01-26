<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Http\Requests\Frontend\User\StoreUserRequest;
use App\Repositories\Users\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class FrontendLoginController extends FrontendController
{

    private $data = [];
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->guard = "web";
        $this->userRepository = $userRepository;
        parent::__construct();
    }


    public function login(Request $request)
    {
        $user = Auth::guard('web')->user();
        if ( $user ) {
            return redirect(Route('frontend.home.index'));
        }

        if ( $request->getMethod() == 'POST' ) {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'status' => 1
            ];

            $credentialsPhone = [
                'phone' => $request->phone,
                'password' => $request->password,
                'status' => 1
            ];

            if ( Auth::guard('web')->attempt($credentials, true) ) {
                $value = $request->session()->get('url');
                if ( $value ) {
                    return redirect($value);
                }
                return redirect(Route('frontend.home.index'));
            }

            if ( Auth::guard('web')->attempt($credentialsPhone, true) ) {
                $value = $request->session()->get('url');
                if ( $value ) {
                    return redirect($value);
                }
                return redirect(Route('frontend.home.index'));
            }

            return back()->withErrors([
                'error' => 'Vui lòng kiểm tra email và mật khẩu.',
            ]);
        }

        $this->data['urlRedirect'] = Route('frontend.auth.login');
        return view('components.frontend.users.login', $this->data);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxLogin(Request $request)
    {
        if ( $request->getMethod() == 'POST' ) {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'status' => 1
            ];

            if ( Auth::guard('web')->attempt($credentials, true) ) {
                return ResponseHelper::success('Thành công');
            } else {
                return ResponseHelper::error('Vui lòng kiểm tra lại thông tin đăng nhập');
            }
        }
        return ResponseHelper::error('Vui lòng kiểm tra lại thông tin đăng nhập');
    }

    public function register()
    {
        $user = Auth::guard('web')->user();
        if ( $user ) {
            return redirect(Route('frontend.home.index'));
        }
        return View('components.frontend.users.register', $this->data);
    }

    public function store(StoreUserRequest $request)
    {
        $params = $request->all();
        $params['status'] = 0;
        $params['name'] = ucwords($params['name']) ?? '';
        $params['password'] = Hash::make($params['password']);

        $currentTime = date('Y-m-d H:i:s');
        $params['expiry_date'] = date("Y-m-d H:i:s",strtotime("+1 day", strtotime($currentTime)));

        $admin = $this->userRepository->create($params);
        if ( !$admin ) {
            return ResponseHelper::error('Server đang bận không thể tạo tài khoản được');
            //return redirect()->route('frontend.auth.register')->with('error','Server đang bận không thể tạo tài khoản được');
        }

        $credentials = [
            'email' => $request->email,
           // 'status' => 1,
            'password' => $request->password
        ];
        if ( Auth::guard('web')->attempt($credentials, true) ) {
            //return redirect(Route('frontend.home.index'));
            return ResponseHelper::success('Thành công');
        }
    }

    public function logout()
    {
        if ( Auth()->guard('web')->user()->id ) {
            Auth()->guard('web')->logout();
        }
        return redirect(Route('frontend.home.index'));
    }


}
