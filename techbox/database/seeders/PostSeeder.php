<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Post::factory(10)->create();
        \App\Models\Post::all()->each(function ($post) {
            $post->users()->attach([
                'user_id' => rand(1, 10),
                'post_id' => $post->id,
            ]);
            $post->save();
        });
    }
}
