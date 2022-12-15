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
         * Posts 500
         */
        DB::table('permissions')->insert([
            'id' => 511,
            'name' => 'post_view_all',
            'explanation' => 'Alle Posts anschauen',
        ]);
        DB::table('permissions')->insert([
            'id' => 520,
            'name' => 'post_create',
            'explanation' => 'Kann Posts erstellen',
        ]);
        DB::table('permissions')->insert([
            'id' => 530,
            'name' => 'post_update_self',
            'explanation' => 'Eigene Posts bearbeiten',
        ]);
        DB::table('permissions')->insert([
            'id' => 531,
            'name' => 'post_update_all',
            'explanation' => 'Alle Posts bearbeiten',
        ]);
        DB::table('permissions')->insert([
            'id' => 540,
            'name' => 'post_delete_self',
            'explanation' => 'Eigene Posts löschen',
        ]);
        DB::table('permissions')->insert([
            'id' => 541,
            'name' => 'post_delete_all',
            'explanation' => 'Alle Posts löschen',
        ]);
        DB::table('permissions')->insert([
            'id' => 550,
            'name' => 'post_report',
            'explanation' => 'Posts melden',
        ]);
        DB::table('permissions')->insert([
            'id' => 590,
            'name' => 'post_verify',
            'explanation' => 'Posts verifizieren',
        ]);

        /**
         * Kommentare 600
         */
        DB::table('permissions')->insert([
            'id' => 620,
            'name' => 'comment_create',
            'explanation' => 'Kann Kommentare erstellen',
        ]);
        DB::table('permissions')->insert([
            'id' => 630,
            'name' => 'comment_update_self',
            'explanation' => 'Kann eigene Kommentare bearbeiten',
        ]);
        DB::table('permissions')->insert([
            'id' => 631,
            'name' => 'comment_update_all',
            'explanation' => 'Kann alle Kommentare bearbeiten',
        ]);
        DB::table('permissions')->insert([
            'id' => 640,
            'name' => 'comment_delete_self',
            'explanation' => 'Kann eigene Kommentare löschen',
        ]);
        DB::table('permissions')->insert([
            'id' => 641,
            'name' => 'comment_delete_self',
            'explanation' => 'Kann alle Kommentare löschen',
        ]);
        DB::table('permissions')->insert([
            'id' => 650,
            'name' => 'comment_report',
            'explanation' => 'Kann Kommentare melden',
        ]);

        /**
         * Special 900
         */
        DB::table('permissions')->insert([
            'id' => 901,
            'name' => 'view_admin_section',
            'explanation' => 'Kann die Admin Sektion anschauen',
        ]);
        DB::table('permissions')->insert([
            'id' => 920,
            'name' => 'log_viewer',
            'explanation' => 'Kann den Log Viewer benutzen',
        ]);
    }
}
