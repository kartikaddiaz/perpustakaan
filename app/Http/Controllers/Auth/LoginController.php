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

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->route('admin.dashboard'); // arahkan ke dashboard admin
        }
        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            $user = Auth::guard('web')->user();
            if ($user->is_banned) {
                Auth::guard('web')->logout();

                return back()->withErrors([
                    'email' => 'Akun Anda telah diblokir oleh admin dan tidak dapat login.'
                ]);
            }
            return redirect()->route('user.dashboard');
        }
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

    // (opsional, tidak dipakai di logika ini tapi boleh disimpan)
    protected function authenticated(Request $request, $user)
    {
        if ($user->is_banned) {
            Auth::logout();

            return redirect()->route('login')
                ->withErrors(['email' => 'Akun Anda telah diblokir oleh admin dan tidak dapat login.']);
        }
    }
}
