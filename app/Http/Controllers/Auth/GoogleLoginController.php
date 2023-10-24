<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        //$this->guard = "web";
        $this->userRepository = $userRepository;
    }

    public function redirect( Request $request) {
        $scopes = [
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/plus.profile.emails.read',
            'https://www.googleapis.com/auth/drive',
            'https://www.googleapis.com/auth/drive.appdata',
            'https://www.googleapis.com/auth/drive.file',
            'https://www.googleapis.com/auth/drive.metadata',
            'https://www.googleapis.com/auth/drive.metadata.readonly',
            'https://www.googleapis.com/auth/drive.photos.readonly',
            'https://www.googleapis.com/auth/drive.readonly',
            'https://www.googleapis.com/auth/drive.scripts'
        ];

        return Socialite::driver('google')->scopes($scopes)->redirect();
       // return Socialite::driver('google')->redirect();
//        return Socialite::driver('google')
//            ->with(['hd' => 'kenjivietnam.vn'])
//            ->redirect();
    }

    public function callback(Request $request) {
       // $user = Socialite::driver('google')->user();
        $user = Socialite::driver('google')->stateless()->user();
        //$user = Socialite::driver('google')->stateless()->user();
        // OAuth 2.0 providers...
        $token = $user->token;
        $refreshToken = $user->refreshToken;
        $expiresIn = $user->expiresIn;

        // OAuth 1.0 providers...
      //  $token = $user->token;
       // $tokenSecret = $user->tokenSecret;

        $google_id = $user->getId() ;
        $userInfo = $this->userRepository->getAccountGoogle($google_id);

        if($userInfo)
        {
            $userInfo->google_id = $google_id;
            $userInfo->google_token = $token;
            $userInfo->google_refresh_token = $refreshToken;
            $userInfo->name = ucwords($user->getName());
            $userInfo->email = $user->getEmail();
            $userInfo->save();
        }else {

            $currentTime = date('Y-m-d H:i:s');
            $expiry_date = date("Y-m-d H:i:s",strtotime("+1 day", strtotime($currentTime)));
            $userInfo = $this->userRepository->create([
                'google_id'=>$google_id,
                'google_token'=>$token,
                'google_refresh_token'=>$refreshToken,
                'name'=>ucwords($user->getName()),
                'email'=>$user->getEmail(),
                'password'=>'',
                'status'=>1,
                'expiry_date'=>$expiry_date,
            ]);
        }

        $credentials = ['google_id'=>$google_id];
     //   dd($credentials);
       // Auth::guard('web')->attempt($credentials, true);
        Auth::guard('web')->login($userInfo,true);
        return redirect(Route('frontend.home.index'));

        /*
        $user->getNickname();
        $user->getName();
        $user->getEmail();
        $user->getAvatar();
        dd($user->getId(),$user->getName(),$user->getEmail(),$user->getAvatar());
        */
    }
}
