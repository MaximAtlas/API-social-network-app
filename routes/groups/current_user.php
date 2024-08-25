<?php

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/user', 'as' => 'user'], function () {
    Route::post('/register', RegisterController::class)->name('register');
    Route::post('/login', \App\Http\Controllers\Api\LoginController::class)->middleware('loginType')->name('login');
    Route::controller(UserController::class)->middleware('auth:sanctum')->group(function () {
        Route::post('/avatar', 'avatar')->name('avatar');
        Route::get('/profile', 'profile')->name('profile');
        Route::patch('/update', 'update')->name('update');
    });

});
