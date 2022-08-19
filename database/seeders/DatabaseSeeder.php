<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Member;
use App\Models\User;
use App\Models\Staff;
use App\Models\School;
use App\Models\StaffUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Book::factory(20)->create();
        Member::factory(20)->create();
        Staff::factory(20)->create();
        // \App\Models\User::factory(10)->create();

        $user = [
            [
                'name' => 'Staff',
                'username' => 'Staff',
                'password' =>bcrypt('123'),
                'role'=> 'Staff',
                'email'=> 'staff@gmail.com',
            ],
            [
                'name' => 'Member 1',
                'username' => 'Member 1',
                'password' =>bcrypt('12345678'),
                'role'=> 'Member',
                'email'=> 'Member1@gmail.com',
            ]
            ];

            foreach($user as $key => $value) {
                User::create($value);
            }
        
             School::create([
            'nama' => 'SMK NEGERI 1 Cibinong',
            'alamat' => 'Jl. Karadenan No.7, Karadenan, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16111',
            'kota' => 'Kabupaten Bogor',
            'kode_pos' => '16111',
            'email' => 'admin@smkn1cibinong.sch.id',
            'website' => 'https://smkn1cibinong.sch.id/',
            'fax' => '622518665558',
            'nomor_telepon' => '622518663846'
        ]);
    }
}