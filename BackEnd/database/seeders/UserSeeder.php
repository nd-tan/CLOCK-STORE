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
        $admin = User::create([
            'name' => 'Phan Ngọc Cường',
            'address' => '133 Lý Thường Kiệt',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'phone' => '0337868789',
            'birthday' => '1996-07-07',
            'image' => 'a',
            'gender' => 'nam',
            'province_id' => 1,
            'district_id' => 1,
            'ward_id' => 1,
            'group_id' => 1,
        ]);
        $writer = User::create([
            'name' => 'Nguyễn Đức Tân',
            'address' => '133 Lý Thường Kiệt',
            'email' => 'ductan@gmail.com',
            'password' => bcrypt('123'),
            'phone' => '0337868789',
            'birthday' => '1993-02-03',
            'image' => 'a',
            'gender' => 'nam',
            'province_id' => 2,
            'district_id' => 2,
            'ward_id' => 2,
            'group_id' => 2,
        ]);
        $manager = User::create([
            'name' => 'Mai Xuân Cường',
            'address' => '133 Lý Thường Kiệt',
            'email' => 'xuancuong@gmail.com',
            'password' => bcrypt('123'),
            'phone' => '0337868789',
            'birthday' => '2001-01-02',
            'image' => 'a',
            'gender' => 'nam',
            'province_id' => 3,
            'district_id' => 3,
            'ward_id' => 3,
            'group_id' => 3,
        ]);
        $employee = User::create([
            'name' => 'Ly Ly',
            'address' => '133 Lý Thường Kiệt',
            'email' => 'lyly@gmail.com',
            'password' => bcrypt('123'),
            'phone' => '0337868789',
            'birthday' => '1996-07-07',
            'image' => 'a',
            'gender' => 'nữ',
            'province_id' => 4,
            'district_id' => 4,
            'ward_id' => 4,
            'group_id' => 4,
        ]);
        $admin_role = Role::create([
            'name' => 'super admin',
        ]);
        $writer_role = Role::create([
            'name' => 'writer',
        ]);
        $manager_role = Role::create([
            'name' => 'manager',
        ]);
        $Employee_role = Role::create([
            'name' => 'employee',
        ]);
    }
}
