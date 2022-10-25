<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = Brand::create([
            'id' => 1,
            'name' => 'Orient',
            'image' => 'MacBook',
        ]);
        $brand = Brand::create([
            'id' => 2,
            'name' => 'Citizen',
            'image' => 'MacBook',
        ]);
        $brand = Brand::create([
            'id' => 3,
            'name' => 'Casio',
            'image' => 'MacBook',
        ]);
        $brand = Brand::create([
            'id' => 4,
            'name' => 'Seiko',
            'image' => 'MacBook',
        ]);
        $brand = Brand::create([
            'id' => 5,
            'name' => 'Tissot',
            'image' => 'MacBook',
        ]);

    }
}
