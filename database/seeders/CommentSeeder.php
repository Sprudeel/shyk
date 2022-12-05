<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'post_id' => 1,
            'comment_on' => 'post',
            'comment_parent' => 0,
            'commenter' => 1,
            'content' => 'Das ist ein Kommentar unter einem Post',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('comments')->insert([
            'post_id' => 1,
            'comment_on' => 'comment',
            'comment_parent' => 1,
            'commenter' => 1,
            'content' => 'Das ist ein Kommentar unter einem Kommentar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('comments')->insert([
            'post_id' => 1,
            'comment_on' => 'post',
            'comment_parent' => 0,
            'commenter' => 1,
            'content' => 'Das ist ein anderer Kommentar unter einem Post',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
