<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //isbn,judul,penulis,penerbit,cover,kategori
            'isbn' => fake()->numerify('#############'),
            'judul' => fake()->sentence(mt_rand(1,5)),
            'penulis' => fake()->name(),
            'penerbit' => fake()->company(),
            // 'cover' => fake()->image(storage_path('images'), 1000, 625, 'scenery', true, true, null , true, 'jpg'),
            'kategori' => fake()->words(mt_rand(1,2)),

        ];
    }
}