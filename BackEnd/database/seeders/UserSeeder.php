<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            [
                'id' => 1,
                'name' => 'Phan Ngọc Cường',
                'address' => '133 Lý Thường Kiệt , Thành Phố Đông Hà , Tỉnh Quảng Trị',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(123),
                'remember_token' => "123",
                'birthday' => '07-07/1996',
                'image' => 'a',
                'gender' => 'nam',
                'province_id' => 1,
                'district_id' => 1,
                'ward_id' => 1,
                'group_id' => 1,

            ]
        ]);
    }
}
