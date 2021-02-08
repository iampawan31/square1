<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\PostsController;
use App\Http\Controllers\API\v1\Auth\LoginController;
use App\Http\Controllers\API\v1\Auth\RegisterController;

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
        Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
            return $request->user();
        });

        Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'auth:sanctum'], function () {
            Route::get('posts', function () {
                return response()->json(['posts' => auth()->user()->posts]);
            })->name('posts');
        });

        Route::get('posts', [PostsController::class, 'index'])->name('posts');

        Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
            Route::post('register', [RegisterController::class, 'register'])->name('register');
            Route::post('login', [LoginController::class, 'login'])->name('login');
        });
    });
});
