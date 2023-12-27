<?php

namespace App\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IPostRepository
{
    public function index(): LengthAwarePaginator;
}