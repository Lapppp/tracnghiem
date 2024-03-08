<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class FrontendMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle( Request $request, Closure $next )
    {
        $user = Auth::guard('web')->user();
        if ( !$user ) {
            $url = $request->url();
            session(['url' => $url]);
            return redirect(Route('frontend.auth.login'));
        }

        if ( $user ) {
            if(!empty($user->is_force_login)){
                return redirect(Route('frontend.user.logout'));
            }

            if($user->locked == 1){
                return redirect(Route('frontend.about.locked'));
            }
        }

        return $next($request);

    }
}
