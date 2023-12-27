<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\ICommentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommentRepository implements ICommentRepository
{

    public function index(Post $post): LengthAwarePaginator
    {
        return $post->comments()->ofApproved()->paginate(10);
    }
}