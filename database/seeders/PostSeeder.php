<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => 'shyk - news',
            'author' => 1,
            'topic' => 'shyk',
            'category' => 'questions',
            'status' => 'public',
            'content' => 'Lorem Ipsum',
            'created_at' => now(),
        ]);

        DB::table('posts')->insert([
            'title' => 'Mathematik',
            'author' => 1,
            'topic' => 'math',
            'category' => 'questions',
            'status' => 'public',
            'content' => 'Lorem Ipsum',
            'created_at' => now(),
        ]);

        DB::table('posts')->insert([
            'title' => 'GGGGGGGGGGGGGGGGGGGGGGGGGGGGGG',
            'author' => 1,
            'topic' => 'shyk',
            'category' => 'summaries',
            'status' => 'public',
            'content' => 'Lorem Ipsum',
            'created_at' => now(),
        ]);

        DB::table('posts')->insert([
            'title' => 'Mathematik Zusammenfassung Analysis',
            'author' => 1,
            'topic' => 'math',
            'category' => 'summaries',
            'status' => 'public',
            'content' => 'Lorem Ipsum',
            'created_at' => now(),
        ]);
    }
}
