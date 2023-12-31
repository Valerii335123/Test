<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\FileService;
use App\Services\PostService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{

    public function __construct(
        private readonly PostService $postService,
        private readonly FileService $fileService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        Gate::authorize('view post');

        $posts = $this->postService->getPosts();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): PostResource
    {
        Gate::authorize('create post');

        $data = $request->validated();
        if (isset($data['image'])) {
            $file = $data['image'];
            $data['image'] = $this->fileService->saveImage($file);
        }

        $post = Post::create($data);
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): PostResource
    {
        Gate::authorize('view', $post);
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): PostResource
    {
        Gate::authorize('update', $post);

        $data = $request->validated();
        if (isset($data['image'])) {
            $file = $data['image'];
            $data['image'] = $this->fileService->saveImage($file);
        }

        $post->update($data);
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): JsonResponse
    {
        Gate::authorize('delete', $post);

        $post->delete();
        return new JsonResponse([
            'message' => __('Post successful deleted'),
        ]);
    }
}
