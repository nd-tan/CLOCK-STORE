<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::create([
            'id' => 1,
            'name' => 'Orient Powermatic',
            'quantity' => 5,
            'price' => 12000000,
            'type_gender' => 'male',
            'description' => 'Chiếc đồng hồ Orient Powermatic thuộc bộ sưu tập Orient Le Locle Powermatic 80
                                mang đến sự sang trọng và lịch lãm dành cho quý ông. Sử dụng bộ máy cơ tự động
                                có thời gian trữ cót lên đến 80 giờ.',
            'image' => 'a1',
            'status' => '0',
            'category_id' => '1',
            'brand_id' => '1',
            'supplier_id' => '1',
        ]);
        $product = Product::create([
            'id' => 2,
            'name' => 'Casio World Time',
            'quantity' => 5,
            'price' => 11000000,
            'type_gender' => 'male',
            'description' => 'Đồng hồ nam Casio World Time có mặt đồng hồ vuông to với phong cách thể thao,
                                 mặt số điện tử với những tính năng hiện đại tiện dụng,
                                  kết hợp với dây đeo bằng kim loại đem lại vẻ mạnh mẽ cá tính dành cho phái nam.',
            'image' => 'b1',
            'status' => '0',
            'category_id' => '3',
            'brand_id' => '2',
            'supplier_id' => '2',
        ]);
        $product = Product::create([
            'id' => 3,
            'name' => 'Citizen Romantic',
            'quantity' => 5,
            'price' => 3000000,
            'type_gender' => 'male',
            'description' => 'Ẩn chứa dưới vẻ ngoài giản dị của mẫu Citizen Romantic với mẫu dây da lịch lãm tông màu nâu,
                              các chi tiết vạch số tạo hình mỏng chứa đựng sự tinh tế sang trọng khi được bao phủ tông màu vàng nổi bật',
            'image' => 'c1',
            'status' => '0',
            'category_id' => '2',
            'brand_id' => '3',
            'supplier_id' => '3',
        ]);
        $product = Product::create([
            'id' => 4,
            'name' => 'Seiko Classic',
            'quantity' => 5,
            'price' => 7000000,
            'type_gender' => 'female',
            'description' => 'Mẫu đồng hồ Seiko Classic vẻ ngoài giản dị đặc trưng đến từ thương hiệu Seiko,
                                 các chi tiết đồng hồ tạo nét thanh mảnh mang lại sự trẻ trung thời trang cho
                                 các phái đẹp với mẫu dây lưới vàng hồng.',
            'image' => 'd1',
            'status' => '0',
            'category_id' => '4',
            'brand_id' => '4',
            'supplier_id' => '4',
        ]);
        $product = Product::create([
            'id' => 4,
            'name' => 'Tissot Diamon',
            'quantity' => 5,
            'price' => 7000000,
            'type_gender' => 'female',
            'description' => 'Mẫu Tissot Diamon mặt số vuông kiểu dáng nhỏ nhắn trẻ trung cho phái đẹp,
                             điểm nhấn nổi bật cùng với thiết kế siêu mỏng với phần vỏ máy pin chỉ dày 6mm.',
            'image' => 'e1',
            'status' => '0',
            'category_id' => '5',
            'brand_id' => '5',
            'supplier_id' => '5',
        ]);

    }
}
