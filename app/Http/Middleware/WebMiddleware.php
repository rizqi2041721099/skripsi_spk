<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WebMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->check()){
            return redirect('/login');
        }
        if(!auth()->user()->hasRole(['ADMIN','USER'])){
           return redirect('/home');
        }else{
            return $next($request);
        }
    }
}
