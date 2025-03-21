<?php

namespace Database\Seeders\Main;

use App\Models\Main\Branch;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::create([
            'user_id' => 1,
            'branch_code' => strtoupper(Str::random(8)),
            'image' => 'IMG1722247571-wine-pos.jpg',
            'name' => 'Wine POS',
            'email' => 'winepos@gmail.com',
            'phone_number' => '0896 - 9022 - 0404',
            'address' => 'Jl. Seta No.32, Larangan RT04/RW04 Gayam Sukoharjo, Jawa Tengah'
        ]);

        Branch::create([
            'user_id' => 1,
            'branch_code' => strtoupper(Str::random(8)),
            'image' => 'IMG1738662428-wine-pos-solo.jpg',
            'name' => 'Wine POS Solo',
            'email' => 'winepossolo@gmail.com',
            'phone_number' => '0895 - 6052 - 10002',
            'address' => 'Jl. Slamet Riyadi No.14, Laweyan RT03/RW02 Surakarta, Jawa Tengah'
        ]);
    }
}
