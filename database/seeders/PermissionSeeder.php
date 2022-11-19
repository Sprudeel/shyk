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
        /**
         * Rollen 200
         */
        DB::table('permissions')->insert([
            'id' => 210,
            'name' => 'roles_view',
            'explanation' => 'Rollen anschauen',
        ]);
        DB::table('permissions')->insert([
            'id' => 220,
            'name' => 'roles_create',
            'explanation' => 'Rollen erstellen',
        ]);
        DB::table('permissions')->insert([
            'id' => 230,
            'name' => 'roles_update',
            'explanation' => 'Rollen bearbeiten',
        ]);
        DB::table('permissions')->insert([
            'id' => 240,
            'name' => 'roles_delete',
            'explanation' => 'Rollen löschen',
        ]);

        /**
         * Berechtigungen 301
         */
        DB::table('permissions')->insert([
            'id' => 310,
            'name' => 'permission_view',
            'explanation' => 'Berechtigungen anschauen',
        ]);

        /**
         * Nutzer 400
         */
        DB::table('permissions')->insert([
            'id' => 450,
            'name' => 'user_report',
            'explanation' => 'Kann Nutzer melden',
        ]);
        DB::table('permissions')->insert([
            'id' => 461,
            'name' => 'userprofile_edit_self',
            'explanation' => 'Eigenes Nutzer Profil editieren',
        ]);
        DB::table('permissions')->insert([
            'id' => 462,
            'name' => 'userprofile_edit_all',
            'explanation' => 'Alle Nutzer Profil editieren',
        ]);
        DB::table('permissions')->insert([
            'id' => 491,
            'name' => 'admin_view_users',
            'explanation' => 'Nutzertabelle in Admin Sektion anzeigen',
        ]);
        DB::table('permissions')->insert([
            'id' => 493,
            'name' => 'admin_update_role',
            'explanation' => 'Nutzerrollen bearbeiten',
        ]);

        /**
         * Special 900
         */
        DB::table('permissions')->insert([
            'id' => 901,
            'name' => 'view_admin_section',
            'explanation' => 'Kann die Admin Sektion anschauen',
        ]);
    }
}
