<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'id' => 1,
            'name' => 'Phan Ngọc Cường',
            'group_name' => 'VIP',
        ]);
        $role = Role::create([
            'id' => 2,
            'name' => 'Phan Ngọc Cường',
            'group_name' => 'VIP',
        ]);
        $role = Role::create([
            'id' => 3,
            'name' => 'Phan Ngọc Cường',
            'group_name' => 'VIP',
        ]);
        $role = Role::create([
            'id' => 4,
            'name' => 'Phan Ngọc Cường',
            'group_name' => 'VIP',
        ]);
    }
}
