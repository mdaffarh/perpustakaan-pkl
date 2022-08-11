<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        // \App\Models\User::factory(10)->create();

        // StaffUser::create([
        //     'staff_id' => '1',
        //     'username' => 'admin',
        //     'password' => bcrypt('1234'),
        //     'role' => 'admin'
        // ]);

        // Staff::create([
        //     'nip' => '12946193469',
        //     'name' => 'Admin',
        //     'gender' => 'Laki-laki',
        //     'birth_date' => '2000-01-01',
        //     'phone_number' => '08123312312',
        //     'address' => 'Bogor'
        // ]);

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
            'name' => 'SMK NEGERI 1 Cibinong',
            'address' => 'Jl. Karadenan No.7, Karadenan, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16111',
            'city' => 'Kabupaten Bogor',
            'post_code' => '16111',
            'email' => 'admin@smkn1cibinong.sch.id',
            'website' => 'https://smkn1cibinong.sch.id/',
            'fax' => '+622518665558',
            'phone_number' => '+622518663846'
        ]);
    }
}