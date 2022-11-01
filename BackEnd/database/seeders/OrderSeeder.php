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
        for ($i=1; $i < 6; $i++) { 
            DB::table('orders')->insert([
                [
                    'total' => 1000000*$i,
                    'name_customer' => 'Vinh'.$i,
                    'phone' => '084344235'.$i,
                    'address' => '133 lý Thường Kiệt',
                    'customer_id' => 1*$i,
                    'province_id' => 1*$i,
                    'district_id' => 1*$i,
                    'ward_id' => 1*$i,
                ]
            ]);
            DB::table('order_details')->insert([
                [
                    'order_id' => 1*$i,
                    'product_id' => $i,
                    'quantity' => 2*$i,
                    'total' => 100000*$i,
                    'price_at_time' => 50000*$i,
                ]
            ]);
        }
    }
}
