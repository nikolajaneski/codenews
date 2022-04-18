<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
// front page post
Route::get('/post/{id}', [PostController::class, 'singlePost'])->name('post');

// comments
Route::post('/post/{id}/comment', [CommentController::class, 'store']);
// this is with route model binding
Route::get('/comment/{comment}', [CommentController::class, 'edit']);
Route::delete('/comment/{id}', [CommentController::class, 'destroy']);
Route::put('/comment/{id}', [CommentController::class, 'update']);



