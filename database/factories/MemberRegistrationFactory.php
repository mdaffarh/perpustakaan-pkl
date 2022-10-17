<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MemberRegistration>
 */
class MemberRegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $jk = rand(0, 1) ? 'Laki-laki' : 'Perempuan';
        $a=array("RPL","TKJ","MM","SIJA","TP","TKR","TFLM","BKP","DPIB");
        $jurusan=array_rand($a,1);

        return [
            'nama' => fake()->name(),
            'jenis_kelamin' => $jk,
            'kelas' => mt_rand(10,13),
            'jurusan' => $a[$jurusan],
            'tanggal_lahir' => fake()->date(),
            'nomor_telepon' => fake()->phoneNumber(),
            'alamat' => fake()->address(),
            'status' => mt_rand(1,3),
            'created_by' => mt_rand(1,10),
            'updated_by' => mt_rand(1,10)

        ];
    }
}