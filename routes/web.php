<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        "title" => "Home"
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "name" => "Farid Nubaili",
        "email" => "faridnubaili@gmail.com",
        "image" => "farid.jpeg"
    ]);
});

Route::get('/blog', function () {


    return view('posts', [
        "title" => "Posts",
        "posts" => Post::all()
    ]);
});

//Route Single Post
Route::get('posts/{slug}', function ($slug) {

    return view('post', [
        "title" => "SinglePost",
        "post" => Post::find($slug)
    ]);
});
