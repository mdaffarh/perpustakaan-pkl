<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Staff',
                'username' => 'Staff',
                'password' =>bcrypt('12345678'),
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
    }
}
