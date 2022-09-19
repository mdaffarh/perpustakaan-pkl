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
            'judul' => fake()->sentence(mt_rand(1,5)),
            'penulis' => fake()->name(),
            'penerbit' => fake()->company(),
            'kategori' => fake()->words(mt_rand(1,2),true),
            'tglTerbit' => fake()->date(),
            'tglMasuk' => fake()->date(),

        ];
    }
}