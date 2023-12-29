<?php

namespace Tests\Controllers;

use App\Models\Post;
use App\Http\Controllers\API\PostController;
use App\Services\PostService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;
use App\Services\FileService;
use Illuminate\Http\UploadedFile;
use Mockery;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /** @test */
    public function it_returns_a_collection_of_posts()
    {
        $mockPostService = Mockery::mock(PostService::class);
        $mockFileService = Mockery::mock(FileService::class);

        $mockPostService->shouldReceive('getPosts')->once()->andReturn(Post::paginate());

        Gate::shouldReceive('authorize')->with('view post')->once();

        $controller = new PostController($mockPostService, $mockFileService);

        $response = $controller->index();

        $this->assertInstanceOf(AnonymousResourceCollection::class, $response);
    }

    /** @test */
    public function it_stores_a_new_post_and_returns_it_as_a_resource()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('post.jpg');
        $postData = [
            'title' => 'Test Post',
            'content' => 'Test content',
            'slug' => 'test',
            'image' => $file
        ];

        $this->mock(FileService::class, function ($mock) use ($file) {
            $mock->shouldReceive('saveImage')->with($file)->andReturn('path/to/image.jpg');
        });

        Gate::shouldReceive('authorize')->with('create post')->once();

        // Use Laravel's HTTP test method
        $response = $this->postJson(route('post.store'), $postData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', ['title' => 'Test Post']);
    }

    // Add tests for store, show, update, destroy...

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
