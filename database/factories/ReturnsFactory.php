<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Returns>
 */
class ReturnsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = ['Sudah','Belum'];
        return [
            'dikembalikan' => $status[mt_rand(0,1)],
            'tanggal_kembali' => fake()->date(),
            'created_by' => mt_rand(1,10),
            'updated_by' => mt_rand(1,10),
            'member_id' => mt_rand(1,20)
        ];
    }
}