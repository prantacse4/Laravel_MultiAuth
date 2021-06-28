<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCheck
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
     elseif (Auth::user() &&  Auth::user()->is_doctor == 1) {
        return redirect('/admin');
     }
     elseif (Auth::user() &&  Auth::user()->is_user == 1) {
        return redirect('/home');
     }

    return redirect('/');
    }
}
