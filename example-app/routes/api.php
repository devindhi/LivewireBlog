<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\blogController;
use App\Http\Controllers\commentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([\App\Http\Middleware\CheckToken::class])->group(function () {
    Route::get('/home', [blogController::class, 'show'])->name('blog.show');
    Route::post('/home/create', [blogController::class, 'store'])->name('blog.create');
    Route::delete('/home/delete/{id}', [blogController::class, 'delete'])->name('blog.delete');
    Route::patch('/home/update-blog/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::post('/home/comments/{id}', [commentController::class, 'store'])->name('comments.post');
    Route::get('/home/blog/{id}', [blogController::class, 'view'])->name('blog.view');
    Route::delete('/home/blog/comment/{id}', [commentController::class, 'delete'])->name('comment.delete');
});
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');