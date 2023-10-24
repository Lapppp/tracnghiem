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
        if ( !Auth::guard('web')->user() ) {
            $url = $request->url();
            session(['url' => $url]);
            return redirect(Route('frontend.auth.login'));
        }
        return $next($request);

    }
}
