<?php

namespace App\Repositories\Interfaces;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ICommentRepository
{
    public function index(Post $post): LengthAwarePaginator;
}