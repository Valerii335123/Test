<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Interfaces\ICommentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommentService
{

    public function __construct(
        private readonly ICommentRepository $commentRepository
    ) {
    }

    public function getComments(Post $post): LengthAwarePaginator
    {
        return $this->commentRepository->index($post);
    }
}