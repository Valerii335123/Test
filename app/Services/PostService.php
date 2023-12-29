<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Interfaces\IPostRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PostService
{
    public function __construct(
        private readonly IPostRepository $postRepository
    ) {
    }

    public function getPosts(): LengthAwarePaginator
    {
        return $this->postRepository->index();
    }

    public function getCommentatorsEmail(Post $post): Collection
    {
        return $post->comments()->pluck('email')->unique();
    }
}