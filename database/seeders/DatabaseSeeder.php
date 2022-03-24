<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    //  untuk dapat membuat model sekaligus dengan migration, factory, dan seeder
    // kita dapat menggunakan "php artisan make:model nama_model -mfs"

    public function run()
    {

        // untuk mengubah asal data faker berdasarkan negara
        // kita dapat mengubah file config/app.php dan mengganti FAKER_LOCALE

        User::create([
            'name' => 'Farid Nubaili',
            'username' => 'faridnubaili',
            'email' => 'faridnubaili@gmail.com',
            'password' => bcrypt('12345')
        ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Post::factory(20)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quis dolores accusantium aliquam velit.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quis dolores accusantium aliquam velit. Eveniet nihil vel eaque nulla. Similique nemo exercitationem alias placeat temporibus quae reiciendis, aliquam deserunt sit praesentium impedit aliquid saepe esse nam! Quia eum, voluptas dicta unde et nam velit expedita, incidunt ex inventore repellendus maiores dolorum odit sequi nulla quos architecto, commodi officiis optio ea nemo voluptatibus. Rem expedita at in, repudiandae vitae et quas labore accusamus minima quos aliquid id sequi? Sunt consequatur odit soluta nihil eius vel ducimus aperiam molestiae, illum debitis deserunt quam fugiat eveniet, magni voluptate expedita dolor rerum. Atque, obcaecati.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quis dolores accusantium aliquam velit.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quis dolores accusantium aliquam velit. Eveniet nihil vel eaque nulla. Similique nemo exercitationem alias placeat temporibus quae reiciendis, aliquam deserunt sit praesentium impedit aliquid saepe esse nam! Quia eum, voluptas dicta unde et nam velit expedita, incidunt ex inventore repellendus maiores dolorum odit sequi nulla quos architecto, commodi officiis optio ea nemo voluptatibus. Rem expedita at in, repudiandae vitae et quas labore accusamus minima quos aliquid id sequi? Sunt consequatur odit soluta nihil eius vel ducimus aperiam molestiae, illum debitis deserunt quam fugiat eveniet, magni voluptate expedita dolor rerum. Atque, obcaecati.',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);

        // Post::create([
        //     'title' => 'Judul Ketiga',
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quis dolores accusantium aliquam velit.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quis dolores accusantium aliquam velit. Eveniet nihil vel eaque nulla. Similique nemo exercitationem alias placeat temporibus quae reiciendis, aliquam deserunt sit praesentium impedit aliquid saepe esse nam! Quia eum, voluptas dicta unde et nam velit expedita, incidunt ex inventore repellendus maiores dolorum odit sequi nulla quos architecto, commodi officiis optio ea nemo voluptatibus. Rem expedita at in, repudiandae vitae et quas labore accusamus minima quos aliquid id sequi? Sunt consequatur odit soluta nihil eius vel ducimus aperiam molestiae, illum debitis deserunt quam fugiat eveniet, magni voluptate expedita dolor rerum. Atque, obcaecati.',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);

        // Post::create([
        //     'title' => 'Judul Keempat',
        //     'slug' => 'judul-keempat',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quis dolores accusantium aliquam velit.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quis dolores accusantium aliquam velit. Eveniet nihil vel eaque nulla. Similique nemo exercitationem alias placeat temporibus quae reiciendis, aliquam deserunt sit praesentium impedit aliquid saepe esse nam! Quia eum, voluptas dicta unde et nam velit expedita, incidunt ex inventore repellendus maiores dolorum odit sequi nulla quos architecto, commodi officiis optio ea nemo voluptatibus. Rem expedita at in, repudiandae vitae et quas labore accusamus minima quos aliquid id sequi? Sunt consequatur odit soluta nihil eius vel ducimus aperiam molestiae, illum debitis deserunt quam fugiat eveniet, magni voluptate expedita dolor rerum. Atque, obcaecati.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);
    }
}
