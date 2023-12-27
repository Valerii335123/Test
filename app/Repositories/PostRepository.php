<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\IPostRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostRepository implements IPostRepository
{

    public function index(): LengthAwarePaginator
    {
        return Post::query()->ofApproved()->paginate(10);
    }
}