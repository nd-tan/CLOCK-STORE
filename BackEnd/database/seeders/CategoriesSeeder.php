<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::create([
            'id' => 1,
            'name' => 'Đồng hồ thời trang',
        ]);
        $category = Category::create([
            'id' => 2,
            'name' => 'Đồng hồ thông minh',
        ]);
        $category = Category::create([
            'id' => 3,
            'name' => 'Đồng hồ cơ',
        ]);
        $category = Category::create([
            'id' => 4,
            'name' => 'Đồng hồ màn hình cảm ứng',
        ]);
        $category = Category::create([
            'id' => 5,
            'name' => 'Đồng hồ pin',
        ]);
        $category = Category::create([
            'id' => 5,
            'name' => 'Đồng hồ điện tử',
        ]);
        $category = Category::create([
            'id' => 5,
            'name' => '2. Đồng hồ pin',
        ]);
        $category = Category::create([
            'id' => 5,
            'name' => '2. Đồng hồ pin',
        ]);
    }
}
