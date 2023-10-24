<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller
{

    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function redirect( Request $request) {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(Request $request) {
        $user = Socialite::driver('facebook')->user();
        // OAuth 2.0 providers...
       // $token = $user->token;
        //$refreshToken = $user->refreshToken;
        //$expiresIn = $user->expiresIn;

        // OAuth 1.0 providers...
       // $token = $user->token;
       // $tokenSecret = $user->tokenSecret;


        $facebook_id = $user->getId() ;
        $userInfo = $this->userRepository->getAccountFacebook($facebook_id);

        if($userInfo)
        {
            $userInfo->facebook_id = $facebook_id;
            //$userInfo->google_token = $token;
           // $userInfo->google_refresh_token = $refreshToken;
            $userInfo->name = ucwords($user->getName());
            $userInfo->email = $user->getEmail();
            $userInfo->save();
        }else {

            $currentTime = date('Y-m-d H:i:s');
            $expiry_date = date("Y-m-d H:i:s",strtotime("+1 day", strtotime($currentTime)));
            $userInfo = $this->userRepository->create([
                'facebook_id'=>$facebook_id,
               // 'google_token'=>$token,
                //'google_refresh_token'=>$refreshToken,
                'name'=>ucwords($user->getName()),
                'email'=>$user->getEmail(),
                'password'=>'',
                'status'=>1,
                'expiry_date'=>$expiry_date,
            ]);
        }


        Auth::guard('web')->login($userInfo,true);
        return redirect(Route('frontend.home.index'));

        // All providers...
       // $user->getId();
        //$user->getNickname();
        //$user->getName();
       // $user->getEmail();
        //$user->getAvatar();
    }
}
