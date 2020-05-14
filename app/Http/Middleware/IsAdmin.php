<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IsAdmin
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
        $user = auth()->user();
        if(!empty($user) && $user->role == 'admin') {
            return $next($request);
        } elseif(!empty($user) && $user->role == 'customer'){
            return redirect('/');
        } else {
            Session::put('previousURL', $request->path());
            return redirect('login')->with('error', 'Please login with Admin Credentials');
        }
    }
}
