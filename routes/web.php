<?php

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::group(['prefix' => '/news'], function () {
    Route::get('/', [\App\Http\Controllers\NewsController::class, 'list'])->name('news.list');
    Route::get('/{id}', [\App\Http\Controllers\NewsController::class, 'get'])->name('news.get');
});

Route::group(['prefix' => '/news', 'middleware' => ['auth']], function () {
    Route::post('/', [\App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
    Route::get('/{id}/edit', [\App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
    Route::post('/{id}', [\App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
    Route::delete('/{id}', [\App\Http\Controllers\NewsController::class, 'delete'])->name('news.delete');
});

Route::group(['prefix' => '/users'], function () {
    Route::get('/', [\App\Http\Controllers\UserController::class, 'list'])->name('users.list');
    Route::get('/{id}', [\App\Http\Controllers\UserController::class, 'get'])->name('users.get');
});

Route::get('/images/news/{filename}', [\App\Http\Controllers\ImageController::class, 'mockImages'])
    ->name('article.image');
Route::get('/images/users/{filename}', [\App\Http\Controllers\ImageController::class, 'mockImages'])
    ->name('user.image');
