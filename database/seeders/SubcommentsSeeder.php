<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcomments')->insert([
            'post_id' => 1,
            'parent_id' => 1,
            'commenter' => 2,
            'content' => 'Das ist ein Subkommentar unter einem Kommentar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('subcomments')->insert([
            'post_id' => 1,
            'parent_id' => 1,
            'commenter' => 2,
            'content' => 'Das ist ein Subkommentar unter einem Kommentar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('subcomments')->insert([
            'post_id' => 1,
            'parent_id' => 1,
            'commenter' => 2,
            'content' => 'Das ist ein Subkommentar unter einem Kommentar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('subcomments')->insert([
            'post_id' => 1,
            'parent_id' => 1,
            'commenter' => 2,
            'content' => 'Das ist ein Subkommentar unter einem Kommentar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('subcomments')->insert([
            'post_id' => 1,
            'parent_id' => 1,
            'commenter' => 2,
            'content' => 'Das ist ein Subkommentar unter einem Kommentar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('subcomments')->insert([
            'post_id' => 1,
            'parent_id' => 1,
            'commenter' => 2,
            'content' => 'Das ist ein Subkommentar unter einem Kommentar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('subcomments')->insert([
            'post_id' => 1,
            'parent_id' => 1,
            'commenter' => 2,
            'content' => 'Das ist ein Subkommentar unter einem Kommentar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('subcomments')->insert([
            'post_id' => 1,
            'parent_id' => 1,
            'commenter' => 2,
            'content' => 'Das ist ein Subkommentar unter einem Kommentar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
