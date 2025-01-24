<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CommentController;
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

Route::post('/articles/{article}/increment-likes', [ArticleController::class, 'incrementLikes'])->name('articles.incrementLikes');
Route::post('/articles/{article}/increment-views', [ArticleController::class, 'incrementViews'])->name('articles.incrementViews');
Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
