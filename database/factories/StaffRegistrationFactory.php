<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StaffRegistration>
 */
class StaffRegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $jk = rand(0, 1) ? 'Laki-laki' : 'Perempuan';
        return [
              'nama' => fake()->name(),
              'jenis_kelamin' => $jk,
              'tanggal_lahir' => fake()->date(),
              'nomor_telepon' => fake()->phoneNumber(),
              'alamat' => fake()->address(),
              'email' => fake()->email(),
              'status' => mt_rand(1,3),
              'created_by' => mt_rand(1,10),
              'updated_by' => mt_rand(1,10)
        ];
    }
}