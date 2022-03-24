<?php

use App\Models\Category;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminUsersController;

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
        "title" => "Home",
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

Route::get('/posts', [PostController::class, 'index']);

// Route Single Post menggunakan route implicit model binding
// akan mengirimkan object menggunakan field slug  
// menuju method show dalam class PostController
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        'categories' => Category::all()
    ]);
});

// middleware digunakan untuk membatasi tampilan ketika user telah login
// dapat diakses melalui app/middleware/kernel.php
// jika middleware gagal, maka akan diarahkan ke route default 
// yang dapat diatur pada app/providers/routeserviceprovider.php

// name(login) digunakan untuk named route agar authenticate dpat jalan
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(('auth'));

Route::get('dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware();

// otomatis akan mengarah ke index jika methodnya get
// mengarah ke store jika method post
// method put ke update
// method delet maka diarahkan ke destroy
// lebih lengkap dapat dicek dengan php artisan route:list

// controller resource memiliki beberapa method CRUD terhadap model yang tergenerate otomatis
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// membuat middleware sendiri
// php artisan make middleware
// pergi ke folder middleware
// kemudian masukkan nama middleware ke kernel.php 
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');

Route::resource('/dashboard/users', AdminUsersController::class)->except('show')->middleware('admin');

//customizing the key dapat mengubah nilai default dari parameter
//ditulis pada file model

//resource controller dilakukan untuk CRUD
// Load merupakan lazy eager loading yang dilakukan pada route model binding
// Route::get('/categories/{category:slug}', function (Category $category) {
//     return view('posts', [
//         'title' => "Post by Category :$category->name",
//         'active' => 'categories',
//         'posts' => $category->posts->load('category', 'author')
//     ]);
// });

// Route::get('/authors/{author:username}', function (User $author) {
//     return view('posts', [
//         'title' => "Post by Author : $author->name",
//         'active' => 'posts',
//         'posts' => $author->posts->load('category', 'author')
//     ]);
// });
