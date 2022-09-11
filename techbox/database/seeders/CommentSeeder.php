<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        \App\Models\Comment::factory(10)->create();
        \App\Models\Comment::all()->each(function ($comment) {
            $comment->users()->attach([
                'user_id' => rand(1, 10),
                'comment_id' => $comment->id,
            ]);
            
            $comment->posts()->attach([
                'comment_id' => $comment->id,
                'post_id' => rand(1, 10),
            ]);
            $comment->save();
        });

    }
}
