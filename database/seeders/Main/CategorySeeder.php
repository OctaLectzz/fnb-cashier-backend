<?php

namespace Database\Seeders\Main;

use App\Models\Main\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'user_id' => 1,
            'slug' => 'makanan',
            'name' => 'Makanan',
            'description' => ''
        ]);

        Category::create([
            'user_id' => 1,
            'slug' => 'minuman',
            'name' => 'Minuman',
            'description' => 'Berbagai jenis minuman, seperti kopi, teh, dan jus.'
        ]);

        Category::create([
            'user_id' => 1,
            'slug' => 'lainnya',
            'name' => 'Lainnya',
            'description' => 'Makanan pencuci mulut seperti cake, pudding, dan es krim.'
        ]);
    }
}
