<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Coba login ke guard 'admin' dulu
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->route('admin.dashboard'); // arahkan ke dashboard admin
        }

        // Kalau gagal, coba login ke guard 'web' (pengguna biasa)
        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->route('user.dashboard'); // arahkan ke dashboard user
        }

        // Kalau dua-duanya gagal
        return back()->withErrors(['email' => 'Email atau sandi salah.']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
