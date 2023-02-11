<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->intended('admin')->with('success', 'Berhasil login');
        }

        return redirect()->back()->with('error', 'Email atau password salah');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
