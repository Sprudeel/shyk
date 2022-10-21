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
            'name' => 'view_homepage',
            'explanation' => 'Kann die Homepage anschauen',
        ]);

        DB::table('permissions')->insert([
            'name' => 'view_admin_section',
            'explanation' => 'Kann die Admin Sektion anschauen',
        ]);

        /**
         * Rollen
         */
        DB::table('permissions')->insert([
            'name' => 'roles_view',
            'explanation' => 'Rollen anschauen',
        ]);
        DB::table('permissions')->insert([
            'name' => 'roles_create',
            'explanation' => 'Rollen erstellen',
        ]);
        DB::table('permissions')->insert([
            'name' => 'roles_delete',
            'explanation' => 'Rollen löschen',
        ]);
        DB::table('permissions')->insert([
            'name' => 'roles_update',
            'explanation' => 'Rollen bearbeiten',
        ]);

        /**
         * Berechtigungen
         */
        DB::table('permissions')->insert([
            'name' => 'permission_view',
            'explanation' => 'Berechtigungen anschauen',
        ]);

        /**
         * Nutzer
         */
        DB::table('permissions')->insert([
            'name' => 'admin_view_users',
            'explanation' => 'Nutzertabelle in Admin Sektion anzeigen',
        ]);
        DB::table('permissions')->insert([
            'name' => 'admin_update_role',
            'explanation' => 'Nutzerrollen bearbeiten',
        ]);
    }
}
