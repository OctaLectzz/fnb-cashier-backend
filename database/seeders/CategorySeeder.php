<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'slug' => 'makanan',
            'name' => 'Makanan',
            'description' => ''
        ]);

        Category::create([
            'slug' => 'minuman',
            'name' => 'Minuman',
            'description' => 'Berbagai jenis minuman, seperti kopi, teh, dan jus.'
        ]);

        Category::create([
            'slug' => 'lainnya',
            'name' => 'Lainnya',
            'description' => 'Makanan pencuci mulut seperti cake, pudding, dan es krim.'
        ]);
    }
}
