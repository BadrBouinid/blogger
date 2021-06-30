<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Auth;
class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        
        if(Auth::check() && Auth::user()->isAdmin()){ //Check your users' role or permission, in my case only admin role for routes
            return $next($request);
        }
       
        return redirect('/');
       
}
}