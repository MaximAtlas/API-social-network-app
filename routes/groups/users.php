<?php

use App\Http\Controllers\Api\UserController;

Route::controller(UserController::class)->middleware('auth:sanctum')->group(function () {
    Route::prefix('/users')->as('users')->group(function () {
        Route::get('/{user}', 'getById')->name('getById');
        Route::get('/{user}/posts', 'getUserPosts')->name('getUserPosts');
        Route::get('/{user}/subscribers', 'subscribers')->name('subscribers');
        Route::post('/{user}/subscribe', 'subscribe')->name('subscribe');
    });
});
