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
        // DB::table('comments')->insert([
        //     'parent_id' => 1,
        //     'commenter' => 1,
        //     'content' => 'Das ist ein Kommentar unter einem Post',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // DB::table('comments')->insert([
        //     'parent_id' => 1,
        //     'commenter' => 2,
        //     'content' => 'Das ist ein anderer Kommentar unter einem Post',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

    }
}
