<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'user4',
                'email' => 'user4@gmail.com',
                'password' => Hash::make('user4444'),
                'phone' => '07777777777',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user5',
                'email' => 'user5@gmail.com',
                'password' => Hash::make('user5555'),
                'phone' => '07777777777',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user6',
                'email' => 'user6@gmail.com',
                'password' => Hash::make('user6666'),
                'phone' => '07777777777',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user7',
                'email' => 'user7@gmail.com',
                'password' => Hash::make('user7777'),
                'phone' => '07777777777',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user8',
                'email' => 'user8@gmail.com',
                'password' => Hash::make('user8888'),
                'phone' => '07777777777',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user9',
                'email' => 'user9@gmail.com',
                'password' => Hash::make('user9999'),
                'phone' => '07777777777',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
