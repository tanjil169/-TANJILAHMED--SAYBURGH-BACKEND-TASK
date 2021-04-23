<?php

use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CardController::class, 'home'])->name('homepage');
Route::get('/post/{id}', [CardController::class, 'postDetails'])->name('post.details');

Auth::routes();

Route::group(['middleware' => 'auth:web'], function () {
    Route::resource('/card', CardController::class);

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::view('view','cardview');
