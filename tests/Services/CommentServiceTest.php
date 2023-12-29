<?php

namespace Tests\Services;

use App\Models\User;
use Tests\TestCase;
use App\Models\Post;
use App\Services\CommentService;
use App\Repositories\Interfaces\ICommentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Mockery;

class CommentServiceTest extends TestCase
{
    /** @test */
    public function it_returns_paginated_comments_for_a_post()
    {
        $mockRepository = Mockery::mock(ICommentRepository::class);
        User::factory()->create(['id' => 1]);
        $post = Post::factory()->create(['user_id' => 1]);
        $expectedResult = Mockery::mock(LengthAwarePaginator::class);

        $mockRepository->shouldReceive('index')
            ->once()
            ->with($post)
            ->andReturn($expectedResult);

        $commentService = new CommentService($mockRepository);

        $result = $commentService->getComments($post);

        $this->assertSame($expectedResult, $result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
