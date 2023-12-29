<?php

namespace Tests\Repositories;

use App\Models\User;
use Tests\TestCase;
use App\Models\Post;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_paginated_approved_comments_for_post()
    {
        User::factory()->create(['id' => 1]);
        $post = Post::factory()->create(['user_id' => 1]);

        Comment::factory()->count(15)->create(['post_id' => $post->id, 'is_approved' => true]);
        Comment::factory()->count(5)->create(['post_id' => $post->id, 'is_approved' => false]);

        $repository = new CommentRepository();

        $result = $repository->index($post);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertCount(10, $result->items());
        foreach ($result as $comment) {
            $this->assertEquals(1, $comment->is_approved);
        }
    }
}
