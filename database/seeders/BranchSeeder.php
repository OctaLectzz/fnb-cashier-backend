<?php

namespace Database\Seeders;

use App\Models\Branch;
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
            'branch_code' => strtoupper(Str::random(8)),
            'image' => 'IMG1722247571-wine-pos.jpg',
            'name' => 'Wine POS',
            'email' => 'winepos@gmail.com',
            'phone_number' => '0896 - 9022 - 0404'
        ]);

        Branch::create([
            'branch_code' => strtoupper(Str::random(8)),
            'image' => 'IMG1738662428-wine-pos-solo.jpg',
            'name' => 'Wine POS Solo',
            'email' => 'winepossolo@gmail.com',
            'phone_number' => '0895 - 6052 - 10002',
            'address' => 'Jl. Slamet Riyadi, No. 108, Laweyan, Surakarta',
            'status' => 0
        ]);
    }
}
