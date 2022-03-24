<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'login'
            // ,'active' => 'login'
        ]);
    }

    // autentikasi juga dapat dilakukan dengan starter kit breeze dan jetstream
    // selain itu juga dapat dilakukan secara manual dengan facade
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // jika terautentikasi maka redirect ke dashboard
        if (Auth::attempt($credentials)) {
            // session regenerate menghindari kejahatan session fixation 
            $request->session()->regenerate();

            // redirect user sebelum memasuki middleware
            return redirect()->intended('/dashboard');
        }

        // kembali ke halaman sebelum melakukan route dan menyertakan flash message
        return back()->with('loginError', 'Login failed!');
    }

    // logout terdapat pada file app/http/middleware/authenticate/php
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // agar tidak bisa dipakai
        $request->session()->regenerateToken(); // agar tidak dibajak
        return redirect('/'); //redirect setelah logout
    }
}
