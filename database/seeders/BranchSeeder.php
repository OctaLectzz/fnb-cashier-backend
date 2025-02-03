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
    }
}
