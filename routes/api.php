<?php

use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('post', PostController::class)->parameters([
    'post' => 'post:slug',
])->only(['index', 'store', 'show', 'update', 'destroy']);

Route::apiResource('post/{post:slug}/comment', CommentController::class)
    ->only(['index', 'store', 'show', 'update', 'destroy']);