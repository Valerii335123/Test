<?php

namespace Tests\Services;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Comment;
use App\Services\PostService;
use App\Repositories\Interfaces\IPostRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Mockery;

class PostServiceTest extends TestCase
{
    /** @test */
    public function it_retrieves_paginated_posts()
    {
        $mockRepository = Mockery::mock(IPostRepository::class);
        $expectedResult = Mockery::mock(LengthAwarePaginator::class);
        $mockRepository->shouldReceive('index')->once()->andReturn($expectedResult);

        $service = new PostService($mockRepository);

        $result = $service->getPosts();

        $this->assertSame($expectedResult, $result);
    }

    /** @test */
    public function it_retrieves_unique_commentators_emails_for_a_post()
    {
        $post = Post::factory()->create();
        Comment::factory()->count(3)->create(['post_id' => $post->id, 'email' => 'test@example.com']);
        Comment::factory()->create(['post_id' => $post->id, 'email' => 'unique@example.com']);

        $service = new PostService(Mockery::mock(IPostRepository::class));

        $emails = $service->getCommentatorsEmail($post);

        $this->assertInstanceOf(Collection::class, $emails);
        $this->assertEquals(2, $emails->count());
        $this->assertTrue($emails->contains('test@example.com'));
        $this->assertTrue($emails->contains('unique@example.com'));
    }
}
