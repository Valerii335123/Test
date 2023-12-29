<?php

namespace Tests\Repositories;

use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class PostRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_paginated_approved_posts()
    {
        // Arrange: Create some posts in the database
        User::factory()->create(['id' => 1]);

        Post::factory()->count(15)->create(['is_approved' => true, 'user_id' => 1]);
        Post::factory()->count(5)->create(['is_approved' => false, 'user_id' => 1]);

        $repository = new PostRepository();

        $result = $repository->index();

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertCount(10, $result);
        $result->each(function ($post) {
            $this->assertEquals(1, $post->is_approved);
        });
    }
}
