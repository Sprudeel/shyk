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
        /**
         * USER PERMISSIONS
         */
        DB::table('role_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 450,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 461,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 520,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 530,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 540,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 550,
        ]);


        /**
         * ADMINISTRATOR PERMISSIONS
         */
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 210,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 220,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 230,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 240,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 310,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 450,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 461,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 462,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 491,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 493,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 511,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 520,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 530,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 531,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 540,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 541,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 550,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 901,
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 920,
        ]);
    }
}
