<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin');

        return view('dashboard.users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'password' => 'required|min:5|max:255'
        ];

        //membandingkan slug request dan slug lama
        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:users|min:3|max:255';
        }

        if ($request->email != $user->email) {
            $rules['email'] = 'required|unique:users|email:rfc,dns';
        }

        $validatedData = $request->validate($rules);
        // $validatedData['password']=bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::where('id', $user->id)
            ->update($validatedData);

        return redirect('dashboard/users')->with('success', "User id: " . $user->id . " has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // mendelete data di database
        User::destroy($user->id);

        return redirect('dashboard/users')->with('success', 'User has been deleted');
    }
}
