<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

public function showLoginForm()
{
    return view('login.login');
}

public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ], [
        'email.required' => 'Field Email wajib diisi!',
        'password.required' => 'Field Password wajib diisi!'
    ]);

    if ($validator->fails()) {
        notify()->error($validator->errors()->first(), 'Gagal');
        return redirect()->back()->withInput();
    }


    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $name = $user->name;
        notify()->success("Selamat datang, $name!");
        return redirect()->intended('/home');
    }

    notify()->error('Email atau kata sandi salah.', 'Gagal');
    return redirect()->route('login')->withInput($request->only('email'));
}


public function logout()
{
    Auth::logout();
    notify()->success('Berhasil keluar!');
    return redirect()->route('login');
}

}