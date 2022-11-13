<?php

use App\Http\Controllers\PersonController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [PostController::class, 'getAll'])->name('dashboard');
    Route::get('/profile/show', [PersonController::class, 'get'])->name('profile.show');
    Route::get('/profile/edit', [PersonController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [PersonController::class, 'update'])->name('profile.update');
    Route::get('/myposts/show', [PostController::class, 'getForCurrentPerson'])->name('myposts.show');
    Route::get('/myposts/edit/{id}', [PostController::class, 'edit'])->name('myposts.edit');
    Route::put('/myposts/edit/{id}', [PostController::class, 'update'])->name('myposts.update');
    Route::delete('/myposts/show/{id}', [PostController::class, 'delete'])->name('myposts.delete');
});

require __DIR__.'/auth.php';
