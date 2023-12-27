<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory(10000)->create()->each(function (Post $post) {
            $post->comments()->saveMany(Comment::factory(50)->make());
        });
    }
}
