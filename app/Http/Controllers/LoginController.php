<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan peran pengguna
            if (Auth::user()->isAdmin == 1 || Auth::user()->isAdmin == 2) {
                return redirect()->intended('dashboard'); // Arahkan admin ke dashboard
            }

            return redirect()->intended('/'); // Arahkan pengguna biasa ke halaman user
        }

        return back()->withErrors([
            'email' => 'Email atau Password yang anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
