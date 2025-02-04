<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'sku' => 'ESP001',
            'slug' => 'espresso-coffee',
            'name' => 'Espresso Coffee',
            'category_id' => 2,
            'min_purchase' => 1,
            'selling_price' => 25000,
            'purchase_price' => 15000,
            'unit' => 'cup',
            'weight' => 0.3,
            'length' => null,
            'width' => null,
            'height' => null,
            'status' => 1
        ]);
        Product::create([
            'sku' => 'CAP002',
            'slug' => 'cappuccino',
            'name' => 'Cappuccino',
            'category_id' => 2,
            'min_purchase' => 1,
            'selling_price' => 30000,
            'purchase_price' => 18000,
            'unit' => 'cup',
            'weight' => 0.35,
            'length' => null,
            'width' => null,
            'height' => null,
            'status' => 1
        ]);
        Product::create([
            'sku' => 'CHK003',
            'slug' => 'chocolate-cake',
            'name' => 'Chocolate Cake',
            'category_id' => 2,
            'min_purchase' => 1,
            'selling_price' => 45000,
            'purchase_price' => 25000,
            'unit' => 'slice',
            'weight' => 0.5,
            'length' => 10.0,
            'width' => 10.0,
            'height' => 5.0,
            'status' => 1
        ]);

        Product::create([
            'sku' => 'NSG001',
            'slug' => 'nasi-goreng-spesial',
            'name' => 'Nasi Goreng Spesial',
            'category_id' => 1,
            'min_purchase' => 1,
            'selling_price' => 40000,
            'purchase_price' => 25000,
            'unit' => 'porsi',
            'weight' => 0.5,
            'length' => null,
            'width' => null,
            'height' => null,
            'status' => 1
        ]);
        Product::create([
            'sku' => 'AYG002',
            'slug' => 'ayam-geprek',
            'name' => 'Ayam Geprek',
            'category_id' => 1,
            'min_purchase' => 1,
            'selling_price' => 35000,
            'purchase_price' => 20000,
            'unit' => 'porsi',
            'weight' => 0.4,
            'length' => null,
            'width' => null,
            'height' => null,
            'status' => 1
        ]);
        Product::create([
            'sku' => 'MGJ003',
            'slug' => 'mie-goreng-jawa',
            'name' => 'Mie Goreng Jawa',
            'category_id' => 1,
            'min_purchase' => 1,
            'selling_price' => 38000,
            'purchase_price' => 22000,
            'unit' => 'porsi',
            'weight' => 0.45,
            'length' => null,
            'width' => null,
            'height' => null,
            'status' => 1
        ]);
    }
}
