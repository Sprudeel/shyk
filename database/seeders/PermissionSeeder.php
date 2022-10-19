<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'id' => 1,
            'name' => 'can_view'
        ]);

        DB::table('permissions')->insert([
            'id' => 2,
            'name' => 'can_edit'
        ]);

        DB::table('permissions')->insert([
            'id' => 3,
            'name' => 'nothing'
        ]);
    }
}
