<?php

namespace App\Http\Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VerifyIsAdmin
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if ($user && $user->rol === 'admin') {
            return $next($request);
        }
        return redirect('/home');
    }
}