<?php

namespace Database\Seeders;

use App\Models\GroupRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grouprole = GroupRole::create([
            'id' => 1,
            'group_id' => 1,
            'role_id' => 1,
        ]);
        $grouprole = GroupRole::create([
            'id' => 2,
            'group_id' => 2,
            'role_id' => 2,
        ]);
        $grouprole = GroupRole::create([
            'id' => 3,
            'group_id' => 3,
            'role_id' => 3,
        ]);
        $grouprole = GroupRole::create([
            'id' => 4,
            'group_id' => 4,
            'role_id' => 4,
        ]);
    }
}
