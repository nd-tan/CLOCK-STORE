<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = Group::create([
            'id' => 1,
            'name' => "Admin",
        ]);
        $group = Group::create([
            'id' => 2,
            'name' => "Admin",
        ]);
        $group = Group::create([
            'id' => 3,
            'name' => "Admin",
        ]);
        $group = Group::create([
            'id' => 4,
            'name' => "Admin",
        ]);
    }
}
