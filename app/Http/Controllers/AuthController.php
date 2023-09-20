<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

public function showLoginForm()
{
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
        $user = Auth::user();
        $name = $user->name;
        notify()->success("Selamat datang, $name!");
        return redirect()->intended('/dashboard');
    }

    notify()->error('Email atau kata sandi salah.');
    return redirect()->route('login')->withInput($request->only('email'));
}


public function logout()
{
    Auth::logout();
    notify()->success('Berhasil keluar!');
    return redirect()->route('login');
}

}