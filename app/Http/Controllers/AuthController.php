<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
{
    // dd('Show Login Form');
    return view('login.login');
}

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->intended('/dashboard');
    }

    return redirect()->route('login')->with('error', 'Login gagal. Email atau password salah.');
}

public function logout()
{
    // dd('Logout');
    Auth::logout();
    return redirect()->route('login');
}

}