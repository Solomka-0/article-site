<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.list');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::post('/articles/{id}/increment-likes', [ArticleController::class, 'incrementLikes'])->name('articles.incrementLikes');
Route::post('/articles/{id}/increment-views', [ArticleController::class, 'incrementViews'])->name('articles.incrementViews');

Route::post('/articles/{id}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
