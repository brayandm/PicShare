<?php

use App\Http\Controllers\PostApiController;
use App\Http\Controllers\PremiumController;
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

Route::post('/dashboard/premium/webhook', [PremiumController::class, 'webhook'])->name('webhooks.mollie');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/myposts/create', [PostApiController::class, 'store'])->name('api.myposts.store');
    Route::post('/myposts/update/{id}', [PostApiController::class, 'update'])->name('api.myposts.update');
    Route::post('/myposts/get/{id}', [PostApiController::class, 'get'])->name('api.myposts.get');
    Route::post('/myposts/index', [PostApiController::class, 'index'])->name('api.myposts.index');
    Route::post('/myposts/delete/{id}', [PostApiController::class, 'delete'])->name('api.myposts.delete');
});

