<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Usuario 1',
                'email' => 'usuario1@example.com',
                'password' => bcrypt('password123'),
                'role' => 'user',
            ],
            [
                'name' => 'Usuario 2',
                'email' => 'usuario2@example.com',
                'password' => bcrypt('password123'),
                'role' => 'admin',
            ],
        ];

        DB::table('users')->insert($users);
    }
}
