<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $macbook = Brand::create([
            'id' => 1,
            'name' => 'MacBook',
            'image' => 'MacBook',
        ]);
        $asus = Brand::create([
            'id' => 2,
            'name' => 'Asus',
            'image' => 'MacBook',
        ]);
        $dell = Brand::create([
            'id' => 3,
            'name' => 'Dell',
            'image' => 'MacBook',
        ]);
        $acer = Brand::create([
            'id' => 4,
            'name' => 'Acer',
            'image' => 'MacBook',
        ]);
    }
}
