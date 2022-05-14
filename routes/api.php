<?php

use App\Http\Controllers\v1\AdminController;
use App\Http\Controllers\v1\FaqController;
use App\Http\Controllers\v1\UserController;
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

Route::post('/authenticate', [UserController::class,'authenticate'])->name('authenticate.api');
Route::post('/register', [UserController::class,'register'])->name('login.api');
Route::prefix('v1')->group(function(){
    Route::prefix('faq')->group(function(){
        Route::get('/',[FaqController::class, 'getAllFaqAPI']);
        Route::get('/{id}',[FaqController::class, 'getFaqByIdAPI']);
    });
    Route::prefix('admin')->group(function(){
        Route::get('/',[FaqController::class, 'getAllFaqAPI']);
        Route::get('/{id}',[FaqController::class, 'getFaqByIdAPI']);
        Route::post('/', [AdminController::class, 'createAdminAPI']);
    });
});
