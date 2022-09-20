<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // nis nama jenis_kelamin kelas jurusan tanggal_lahir nomor_telepon alamat
        $jk = rand(0, 1) ? 'Laki-laki' : 'Perempuan';

        return [
            'nis' => fake()->nik(),
            // 'nis' => fake()->numerify('##########'),
            'nama' => fake()->name(),
            'jenis_kelamin' => $jk,
            'kelas' => mt_rand(10,13),
            'jurusan' => fake()->words(mt_rand(1,2), true),
            'tanggal_lahir' => fake()->date(),
            'nomor_telepon' => fake()->phoneNumber(),
            'alamat' => fake()->address(),
            'status' => 1
        ];
    }
}