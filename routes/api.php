<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('users/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');

    Route::group(['prefix' => '/news'], function () {
        Route::post('/', [\App\Http\Controllers\NewsController::class, 'create'])->name('api.news.create');
        Route::post('/{id}', [\App\Http\Controllers\NewsController::class, 'update'])->name('api.news.update');
        Route::delete('/{id}', [\App\Http\Controllers\NewsController::class, 'delete'])->name('api.news.delete');
    });

    Route::group(['prefix' => '/users'], function () {
        Route::post('/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('api.users.update');
    });
});

Route::post('/login', [\App\Http\Controllers\UserController::class, 'loginToken'])->name('api.login');


Route::group(['prefix' => '/news'], function () {
    Route::get('/', [\App\Http\Controllers\NewsController::class, 'list'])->name('api.news.list');
    Route::get('/{id}', [\App\Http\Controllers\NewsController::class, 'get'])->name('api.news.get');
});

Route::group(['prefix' => '/users'], function () {
    Route::get('/', [\App\Http\Controllers\UserController::class, 'list'])->name('api.users.list');
    Route::get('/{id}', [\App\Http\Controllers\UserController::class, 'get'])->name('api.users.get');
});
