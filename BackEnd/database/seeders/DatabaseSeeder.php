<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            SupplierSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProdustImageSeeder::class,
            CustomerSeeder::class,
            GroupSeeder::class,
            RoleSeeder::class,
            GroupRoleSeeder::class,
            UserSeeder::class,
        ]);
    }
    public function importRoles()
    {
        $groups = ['Category', 'User', 'Supplier', 'Product', 'group'];
        $actions = ['viewAny', 'view', 'create', 'update', 'delete', 'restore', 'forceDelete'];
        foreach ($groups as $group) {
            foreach ($actions as $action) {
                DB::table('roles')->insert([
                    'name' => $group . '_' . $action,
                    'group_name' => $group,

                ]);
            }
        }
    }

    public function importRole()
    {
        $groups = ['Customer', 'Order'];
        $actions = ['viewAny', 'view'];
        foreach ($groups as $group) {
            foreach ($actions as $action) {
                DB::table('roles')->insert([
                    'name' => $group . '_' . $action,
                    'group_name' => $group,

                ]);
            }
        }
    }

    public function importGroupRole()
    {
        for ($i = 1; $i <= 35; $i++) {
            DB::table('Group_role')->insert([
                'group_id' => 1,
                'role_id' => $i,
            ]);
        }
    }
    public function importGroupRole_1()
    {
        for ($i = 36; $i <= 39; $i++) {
            DB::table('group_role')->insert([
                'position_id' => 1,
                'role_id' => $i,
            ]);
        }
    }

    public function importGroup()
    {
        $userGroup = new Group();
        $userGroup->name = 'Supper Admin';
        $userGroup->save();

        $userGroup = new Group();
        $userGroup->name = 'Quản Lý';
        $userGroup->save();

        $userGroup = new Group();
        $userGroup->name = 'Giám Đốc';
        $userGroup->save();


        $userGroup = new Group();
        $userGroup->name = 'Nhân Viên';
        $userGroup->save();
    }

    public function importUser()
    {
        $user = new User();
        $user->name = 'Phan Ngọc Cường';
        $user->email = 'cuong@gmail.com';
        $user->password = bcrypt('123');
        $user->phone = '0337868789';
        $user->birthday = '1996/07/07';
        $user->address = 'Quảng Trị';
        $user->image = 'cuong.jpg';
        $user->gender = 'Nam';
        $user->province_id = '2';
        $user->district_id = '2';
        $user->ward_id = '2';
        $user->group_id = '2';
        $user->save();

        $user = new User();
        $user->name = 'Phùng Văn Phi';
        $user->email = 'phi@gmail.com';
        $user->password = bcrypt('123');
        $user->phone = '0777333274';
        $user->birthday = '2002/04/24';
        $user->address = 'Quảng Trị';
        $user->image = 'phi.jpg';
        $user->gender = 'Nam';
        $user->province_id = '3';
        $user->district_id = '3';
        $user->ward_id = '3';
        $user->group_id = '3';
        $user->save();

        $user = new User();
        $user->name = 'Hoàng Thanh Hải';
        $user->email = 'hai@gmail.com';
        $user->password = bcrypt('123');
        $user->phone = '0916663237';
        $user->birthday = '2003/06/27';
        $user->address = 'Quảng Trị';
        $user->image = 'hai.jpg';
        $user->gender = 'Nam';
        $user->province_id = '4';
        $user->district_id = '4';
        $user->ward_id = '4';
        $user->group_id = '4';
        $user->save();

        $user = new User();
        $user->name = 'Nguyễn Ngọc Dương';
        $user->email = 'duong@gmail.com';
        $user->password = bcrypt('123');
        $user->phone = '0123456789';
        $user->birthday = '2001/03/21';
        $user->address = 'Quảng Trị';
        $user->image = 'duong.jpg';
        $user->gender = 'Nam';
        $user->province_id = '5';
        $user->district_id = '5';
        $user->ward_id = '5';
        $user->group_id = '5';
        $user->save();

        $user = new User();
        $user->name = 'Trần Ngọc Vinh';
        $user->email = 'vinh@gmail.com';
        $user->password = bcrypt('123');
        $user->phone = '0123456788';
        $user->birthday = '2003/11/11';
        $user->address = 'Quảng Trị';
        $user->image = 'vinh.jpg';
        $user->gender = 'Nam';
        $user->province_id = '6';
        $user->district_id = '6';
        $user->ward_id = '6';
        $user->group_id = '6';
        $user->save();
    }
}
