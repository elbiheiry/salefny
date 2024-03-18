<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if ($request->route()->getPrefix() === 'api') {
                // return response()->json( 'برجاء تسجيل الدخول أولا', 400);
                abort(response()->json('برجاء تسجيل الدخول أولا', 403));
            }else{
                return route('login');
            }
            
        }
    }
}
