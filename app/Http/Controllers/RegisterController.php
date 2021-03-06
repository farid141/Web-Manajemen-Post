<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        // pada saat meregister, divalidasi terlebih dahulu
        // jika tidak memenuhi, maka akan terdapat pesan error
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        // $validatedData['password']=bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        //flasher laravel dengan mengirimkan session

        // $request->session()->flash('success', 'Registration successfull! Please login');

        // lebih pendek
        return redirect('/login')->with('success', 'Registration successfull! Please login');
    }
}
