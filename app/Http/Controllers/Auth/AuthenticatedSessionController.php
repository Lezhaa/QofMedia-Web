<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended($this->redirectTo());
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    
    protected function redirectTo(): string
    {
        $user = Auth::user();
        
        // Admin QofMedia -> Dashboard Admin
        if ($user->hasRole('admin_qofmedia')) {
            return route('admin.dashboard');
        }
        
        // Admin Studio -> Dashboard Studio
        if ($user->hasRole('admin_studio')) {
            return route('studio.dashboard');
        }
        
        // Admin Apparel -> Dashboard Apparel
        if ($user->hasRole('admin_apparel')) {
            return route('apparel.dashboard');
        }
        
        // User Biasa -> Kembali ke Home (Halaman Publik)
        return route('home');
    }
}