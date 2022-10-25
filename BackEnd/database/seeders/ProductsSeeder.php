<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $macbook = Product::create([
            'id' => 1,
            'name' => 'MacBook Air M1 2020',
            'price' => '33990000',
            'sale_price' => '11',
            'quantity' => '100',
            'brand_id' => '1',
            'category_id' => '1',
            'status' => '1',
            'created_by' => '1',
            'image' => '1',

        ]);
    }
}
