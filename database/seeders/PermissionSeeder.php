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
            'name' => 'admin_roles_permissions',
            'explanation' => 'Kann Berechtigungen, Rollen und Nutzer verwalten',
        ]);

        DB::table('permissions')->insert([
            'name' => 'view_homepage',
            'explanation' => 'Kann die Homepage anschauen',
        ]);
    }
}
