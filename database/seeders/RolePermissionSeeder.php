<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 1
        ]);

        DB::table('role_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 3
        ]);
    }
}
