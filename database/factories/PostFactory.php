<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2, 8,)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            // 'body' => '<p>' . implode('</p><p>', $this->faker->paragraphs(mt_rand(5, 10))) . '</p>',


            //mapping eloquent
            // 'body' => collect($this->faker->paragraphs(mt_rand(5, 10)))
            //     ->map(function ($p) {
            //         return "<p>$p</p>";
            //     }),

            //errow function mapping
            // paragraphs akan mengembalikan kalimat dalam array, tiap array dipisah oleh tag p
            // menggunakan map, tiap array ($p) dibungkus tag p
            // implode akan menggabungkan array dengan delimiter ''
            'body' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                ->map(fn ($p) => "<p>$p</p>")
                ->implode(''),
            'user_id' => mt_rand(1, 3),
            'category_id' => mt_rand(1, 2)
        ];
    }
}
