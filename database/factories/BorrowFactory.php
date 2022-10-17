<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrow>
 */
class BorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $a=array("Menunggu persetujuan","Ditolak","Diterima","Dibatalkan","Disetujui","Dalam peminjaman","Selesai");
        $b=array("Belum","Sudah");
        return [
            'member_id' => mt_rand(1,20),
            'tanggal_pinjam' => fake()->date(),
            'tanggal_tempo' => fake()->date(),
            'status' => $a[mt_rand(0,6)],
            'pengambilan_buku' => $b[mt_rand(0,1)],
            'created_by' => mt_rand(1,10),
            'updated_by' => mt_rand(1,10)
        ];
    }
}