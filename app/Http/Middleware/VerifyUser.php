<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class VerifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Str::of(Auth::user()->type)->contains(['admin', 'super'])) {

            if (Str::of(Auth::user()->type)->contains(['super','admin'])) {
                return Redirect::to('/admin');
            }else if (Str::of(Auth::user()->type)->contains(['doctor','user'])) {
                return Redirect::to('/admin/patients');
            }

            abort(404);
        }


        return $next($request);
    }
}
