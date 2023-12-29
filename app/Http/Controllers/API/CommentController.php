<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct(
        private readonly CommentService $commentService
    ) {
    }

    public function index(Post $post): AnonymousResourceCollection
    {
        Gate::authorize('view comment');

        return CommentResource::collection($this->commentService->getComments($post));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Post $post, StoreCommentRequest $request): CommentResource
    {
        Gate::authorize('create comment');

        $comment = $post->comments()->create($request->validated());
        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, Comment $comment): CommentResource
    {
        Gate::authorize('view', $comment);

        if ($comment->post_id != $post->id) {
            abort(404);
        }

        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post, Comment $comment, UpdateCommentRequest $request): CommentResource
    {
        Gate::authorize('update', $comment);

        if ($comment->post_id != $post->id) {
            abort(404);
        }

        $comment->update($request->validated());
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Comment $comment): JsonResponse
    {
        Gate::authorize('delete', $comment);

        if ($comment->post_id != $post->id) {
            abort(404);
        }

        $comment->delete();
        return new JsonResponse([
            'message' => __('Comment successful deleted'),
        ]);
    }
}
