<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdustImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roductimage = ProductImage::create([
            'id' => 1,
            'image' => 'a2.webp',
            'product_id' => '1'
        ]);
        $roductimage = ProductImage::create([
            'id' => 2,
            'image' => 'a3.webp',
            'product_id' => '1'
        ]);
        $roductimage = ProductImage::create([
            'id' => 3,
            'image' => 'a4.webp',
            'product_id' => '1'
        ]);
        $roductimage = ProductImage::create([
            'id' => 4,
            'image' => 'a5.webp',
            'product_id' => '1'
        ]);
        $roductimage = ProductImage::create([
            'id' => 5,
            'image' => 'a6.webp',
            'product_id' => '1'
        ]);
        $roductimage = ProductImage::create([
            'id' => 6,
            'image' => 'b2.webp',
            'product_id' => '2'
        ]);
        $roductimage = ProductImage::create([
            'id' => 7,
            'image' => 'b3.webp',
            'product_id' => '2'
        ]);
        $roductimage = ProductImage::create([
            'id' => 8,
            'image' => 'b4.webp',
            'product_id' => '2'
        ]);
        $roductimage = ProductImage::create([
            'id' => 9,
            'image' => 'b5.webp',
            'product_id' => '2'
        ]);
        $roductimage = ProductImage::create([
            'id' => 10,
            'image' => 'b6.webp',
            'product_id' => '2'
        ]);
        $roductimage = ProductImage::create([
            'id' => 11,
            'image' => 'c2.webp',
            'product_id' => '3'
        ]);
        $roductimage = ProductImage::create([
            'id' => 12,
            'image' => 'c3.webp',
            'product_id' => '3'
        ]);
        $roductimage = ProductImage::create([
            'id' => 13,
            'image' => 'c4.webp',
            'product_id' => '3'
        ]);
        $roductimage = ProductImage::create([
            'id' => 14,
            'image' => 'c5.webp',
            'product_id' => '3'
        ]);
        $roductimage = ProductImage::create([
            'id' => 15,
            'image' => 'c6.webp',
            'product_id' => '3'
        ]);
        $roductimage = ProductImage::create([
            'id' => 16,
            'image' => 'd2.webp',
            'product_id' => '4'
        ]);
        $roductimage = ProductImage::create([
            'id' => 17,
            'image' => 'd3.webp',
            'product_id' => '4'
        ]);
        $roductimage = ProductImage::create([
            'id' => 18,
            'image' => 'd4.webp',
            'product_id' => '4'
        ]);
        $roductimage = ProductImage::create([
            'id' => 19,
            'image' => 'd5.webp',
            'product_id' => '4'
        ]);
        $roductimage = ProductImage::create([
            'id' => 20,
            'image' => 'd6.webp',
            'product_id' => '4'
        ]);
        $roductimage = ProductImage::create([
            'id' => 21,
            'image' => 'e2.webp',
            'product_id' => '5'
        ]);
        $roductimage = ProductImage::create([
            'id' => 22,
            'image' => 'e3.webp',
            'product_id' => '5'
        ]);
        $roductimage = ProductImage::create([
            'id' => 23,
            'image' => 'e4.webp',
            'product_id' => '5'
        ]);
    }
}
