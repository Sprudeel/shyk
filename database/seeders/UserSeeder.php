<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'username' => 'sprudeel',
        //     'name' => 'Léonard Schafer',
        //     'email' => 'sprudeel@example.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'role_id' => '2',
        //     'avatar' => 'defaults/'.rand(1, 9).'.png',
        //     'about' => 'Hallo mein Name ist sprudel. Ich habe shyk im Rahmen meiner Maturaarbeit geschrieben. Mein Ziel war es einen Ort des Austausches für Schüler:innen zu schaffen. Ich hoffe meine Arbeit gefällt euch. Viel Spass beim Entdecken! Bei Fragen gerne kontaktieren via sprudel@shyk.ch.',
        //     'created_at' => now(),
        // ]);
    }
}
