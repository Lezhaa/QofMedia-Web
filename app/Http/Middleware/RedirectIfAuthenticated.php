<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                if ($user->hasRole('admin_qofmedia')) {
                    return redirect('/admin/dashboard');
                } elseif ($user->hasRole('admin_studio')) {
                    return redirect('/studio/dashboard');
                } elseif ($user->hasRole('admin_apparel')) {
                    return redirect('/apparel/dashboard');
                } else {
                    return redirect('/dashboard');
                }
            }
        }

        return $next($request);
    }
}
