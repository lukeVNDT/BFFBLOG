<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class admin
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
        $role ="admin";
        if(Auth::check() && Auth::user()->hasRole($role)){
            return $next($request);
           }
           return redirect('login')->with('success', 'you need to login as admin to access admin Dashboard');
       
    }
}