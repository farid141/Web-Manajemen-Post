<?php

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
    $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Farid Nubaili",
            "body" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum suscipit ipsum nihil voluptatem dolores animi, pariatur officiis odit excepturi laboriosam rem quasi eum maxime amet aut accusantium magni? Iusto debitis saepe omnis maiores, itaque officiis! Ea voluptates iure dolorum tempore iusto harum deserunt quis perspiciatis itaque, unde, dolore est laboriosam. Quam praesentium possimus, consectetur numquam quaerat ad quidem amet, reprehenderit deserunt qui, mollitia fuga. Reiciendis officia iste impedit suscipit deleniti rerum nam nemo! Est fugiat rerum minus unde debitis tempora."
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Lionel Messi",
            "body" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum suscipit ipsum nihil voluptatem dolores animi, pariatur officiis odit excepturi laboriosam rem quasi eum maxime amet aut accusantium magni? Iusto debitis saepe omnis maiores, itaque officiis! Ea voluptates iure dolorum tempore iusto harum deserunt quis perspiciatis itaque, unde, dolore est laboriosam. Quam praesentium possimus, consectetur numquam quaerat ad quidem amet, reprehenderit deserunt qui, mollitia fuga. Reiciendis officia iste impedit suscipit deleniti rerum nam nemo! Est fugiat rerum minus unde debitis tempora."
        ],
        [
            "title" => "Judul Post Ketiga",
            "slug" => "judul-post-ketiga",
            "author" => "Cristiano Ronaldo",
            "body" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum suscipit ipsum nihil voluptatem dolores animi, pariatur officiis odit excepturi laboriosam rem quasi eum maxime amet aut accusantium magni? Iusto debitis saepe omnis maiores, itaque officiis! Ea voluptates iure dolorum tempore iusto harum deserunt quis perspiciatis itaque, unde, dolore est laboriosam. Quam praesentium possimus, consectetur numquam quaerat ad quidem amet, reprehenderit deserunt qui, mollitia fuga. Reiciendis officia iste impedit suscipit deleniti rerum nam nemo! Est fugiat rerum minus unde debitis tempora."
        ]
    ];

    return view('posts', [
        "title" => "Posts",
        "posts" => $blog_posts
    ]);
});

//Route Single Post
Route::get('posts/{slug}', function ($slug) {
    $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Farid Nubaili",
            "body" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum suscipit ipsum nihil voluptatem dolores animi, pariatur officiis odit excepturi laboriosam rem quasi eum maxime amet aut accusantium magni? Iusto debitis saepe omnis maiores, itaque officiis! Ea voluptates iure dolorum tempore iusto harum deserunt quis perspiciatis itaque, unde, dolore est laboriosam. Quam praesentium possimus, consectetur numquam quaerat ad quidem amet, reprehenderit deserunt qui, mollitia fuga. Reiciendis officia iste impedit suscipit deleniti rerum nam nemo! Est fugiat rerum minus unde debitis tempora."
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Lionel Messi",
            "body" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum suscipit ipsum nihil voluptatem dolores animi, pariatur officiis odit excepturi laboriosam rem quasi eum maxime amet aut accusantium magni? Iusto debitis saepe omnis maiores, itaque officiis! Ea voluptates iure dolorum tempore iusto harum deserunt quis perspiciatis itaque, unde, dolore est laboriosam. Quam praesentium possimus, consectetur numquam quaerat ad quidem amet, reprehenderit deserunt qui, mollitia fuga. Reiciendis officia iste impedit suscipit deleniti rerum nam nemo! Est fugiat rerum minus unde debitis tempora."
        ],
        [
            "title" => "Judul Post Ketiga",
            "slug" => "judul-post-ketiga",
            "author" => "Cristiano Ronaldo",
            "body" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum suscipit ipsum nihil voluptatem dolores animi, pariatur officiis odit excepturi laboriosam rem quasi eum maxime amet aut accusantium magni? Iusto debitis saepe omnis maiores, itaque officiis! Ea voluptates iure dolorum tempore iusto harum deserunt quis perspiciatis itaque, unde, dolore est laboriosam. Quam praesentium possimus, consectetur numquam quaerat ad quidem amet, reprehenderit deserunt qui, mollitia fuga. Reiciendis officia iste impedit suscipit deleniti rerum nam nemo! Est fugiat rerum minus unde debitis tempora."
        ]
    ];

    $new_post = [];
    foreach ($blog_posts as $post) {
        if ($post["slug"] === $slug) {
            $new_post = $post;
        }
    }

    return view('post', [
        "title" => "SinglePost",
        "post" => $new_post
    ]);
});
