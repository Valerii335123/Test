<?php

namespace App\Services;

use App\Repositories\Interfaces\IPostRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
}