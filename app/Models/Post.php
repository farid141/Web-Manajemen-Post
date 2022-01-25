<?php

namespace App\Models;


class Post
{
    private static $blog_posts = [
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

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        //mencari satu dalam collection dimana bagian slug sama dengan $slug
        return static::all()->firstWhere('slug', $slug);
    }
}
