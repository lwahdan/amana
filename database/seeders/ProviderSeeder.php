<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('providers')->insert([
            [
                'name' => 'provider1',
                'email' => 'provider1@gmail.com',
                'password' => Hash::make('provider1111'),
                'phone' => '07777777771',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'provider2',
                'email' => 'provider2@gmail.com',
                'password' => Hash::make('provider2222'),
                'phone' => '07777777772',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'provider3',
                'email' => 'provider3@gmail.com',
                'password' => Hash::make('provider3333'),
                'phone' => '07777777773',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'provider4',
                'email' => 'provider4@gmail.com',
                'password' => Hash::make('provider4444'),
                'phone' => '07777777774',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'provider5',
                'email' => 'provider5@gmail.com',
                'password' => Hash::make('provider5555'),
                'phone' => '07777777775',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'provider6',
                'email' => 'provider6@gmail.com',
                'password' => Hash::make('provider6666'),
                'phone' => '07777777776',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'provider7',
                'email' => 'provider7@gmail.com',
                'password' => Hash::make('provider7777'),
                'phone' => '07777777777',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'provider8',
                'email' => 'provider8@gmail.com',
                'password' => Hash::make('provider8888'),
                'phone' => '07777777778',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'provider9',
                'email' => 'provider9@gmail.com',
                'password' => Hash::make('provider9999'),
                'phone' => '07777777779',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
