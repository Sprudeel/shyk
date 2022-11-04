<?php

namespace Database\Seeders;

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
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'User',
            'color' => '#14A7DB',
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'Admin',
            'color' => '#D12B2B',
        ]);
    }
}
