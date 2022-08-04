<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Staff;
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
    }
}