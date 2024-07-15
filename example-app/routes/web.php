<?php

use App\Http\Controllers\blogController;
use App\Livewire\BlogCard;
use App\Livewire\CreateBlog;
use App\Livewire\Login;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create',CreateBlog::class);
Route::get('/',Login::class)->name('login.view');
Route::get('/register',Register::class);
//Route::get('/home',[blogController::class,'home'])->name('home');

