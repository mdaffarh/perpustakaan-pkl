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
        $a=array("Novel","Komik","Ensiklopedia","Biografi","Majalah","Kamus","Buku Ilmiah","Tafsir");
        $category=array_rand($a,1);
        return [
            //isbn,judul,penulis,penerbit,cover,kategori
            'isbn' => fake()->ean13(),
            'judul' => fake()->sentence(mt_rand(1,2)),
            'penulis' => fake()->name(),
            'penerbit' => fake()->company(2),
            'kategori' => $a[$category],
            'tglTerbit' => fake()->date(),
            'tglMasuk' => fake()->date(),

        ];
    }
}