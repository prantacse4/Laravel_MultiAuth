<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user() &&  Auth::user()->is_admin == 1) {
            return redirect('/admin');
        }
        if (Auth::user() &&  Auth::user()->is_doctor == 1) {
            return redirect('/doctor');
        }

        if (Auth::user() &&  Auth::user()->is_user == 1) {
            return $next($request);
        }

        return redirect('/');
    }
}
