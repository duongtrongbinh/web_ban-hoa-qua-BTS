<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(auth()->check());
        if(auth()->check()){
            // dd(1);
            // dd(auth()->user());
            dd($request);
        return $next($request);

            // return redirect()->to('dashboard');
        }
        return $next($request);
    }
}
