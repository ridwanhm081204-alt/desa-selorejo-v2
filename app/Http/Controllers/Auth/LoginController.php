<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $remember = $request->has('remember');

        if (\Illuminate\Support\Facades\Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $user = \Illuminate\Support\Facades\Auth::user();
            if ($user->role == 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role == 'operator') {
                return redirect()->intended('/operator/dashboard');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Email atau password salah'])->withInput($request->only('email'));
    }

    public function logout()
    {
        \Illuminate\Support\Facades\Auth::logout();
        return redirect('/login');
    }
}
