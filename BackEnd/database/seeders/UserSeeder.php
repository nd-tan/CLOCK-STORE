<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Phan Ngọc Cường',
            'email' => 'cuong@gmail.com',
            'password' => bcrypt('123'),
            'phone' => '0337868789',
            'birthday' => '1996/07/07',
            'address' => 'Quảng Trị',
            'image' => 'cuong.jpg',
            'gender' => 'Nam',
            'province_id' => '2',
            'district_id' => '2',
            'ward_id' => '2',
            'group_id' => '2',
        ]);
    }
}
