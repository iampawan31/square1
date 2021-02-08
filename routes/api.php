<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\PostsController;
use App\Http\Controllers\API\v1\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['as' => 'api.'], function () {
    Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {

        Route::get('posts/user', [PostsController::class, 'getPosts'])->name('posts.get-posts');
        Route::post('posts', [PostsController::class, 'storePost'])->name('posts.save-post');
        Route::get('posts', [PostsController::class, 'index'])->name('posts');

        Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
            Route::post('register', [AuthController::class, 'register'])->name('register');
            Route::get('user', [AuthController::class, 'getUser'])->name('user');
        });
    });
});
