<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'total' => 1000000,
                'name_customer' => 'cuong@gmail.com',
                'phone' => '0843442358',
                'address' => '133 lý Thường Kiệt',
                'customer_id' => 1,
                'province_id' => 1,
                'district_id' => 1,
                'ward_id' => 1,

            ]
        ]);
        DB::table('order_detail')->insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'phone' => '0843442358',
                'quantity' => 2,
                'total' => 100000,
                'price_at_time' => 50000,
            ]
        ]);
    }
}
