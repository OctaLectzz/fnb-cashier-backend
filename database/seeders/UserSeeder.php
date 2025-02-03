<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Owner
        User::create([
            'image' => 'user-profile-default.jpg',
            'name' => 'Wine POS',
            'email' => 'winepos@gmail.com',
            'password' => bcrypt('password'),
            'phone_number' => '0895 - 6052 - 10002'
        ]);
    }
}
