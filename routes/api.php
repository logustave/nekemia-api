<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\v1\AdminController;
use App\Http\Controllers\v1\BlogController;
use App\Http\Controllers\v1\CategoryController;
use App\Http\Controllers\v1\CommentController;
use App\Http\Controllers\v1\ContactController;
use App\Http\Controllers\v1\FaqController;
use App\Http\Controllers\v1\QuestionController;
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

Route::post('/authenticate', [Controller::class,'authenticate'])->name('authenticate.api');
Route::post('/register', [Controller::class,'register'])->name('login.api');
Route::middleware('auth:api')->group(function () {

    Route::prefix('v1')->group(function(){
        Route::prefix('faq')->group(function(){
            Route::get('/',[FaqController::class, 'getAllFaqAPI']);
            Route::get('/{id}',[FaqController::class, 'getFaqByIdAPI']);
        });
        Route::post('/admin',[AdminController::class, 'createAdminAPI']);

        Route::prefix('blog')->group(function (){
            Route::post('', [BlogController::class, 'getAllBlogAPI'])->name('getAllBlogAPI');
            Route::get('{slug}', [BlogController::class, 'getBlogBySlugAPI'])->name('getBlogBySlugAPI');
            Route::get('last-five', [BlogController::class, 'getLastFiveBlogAPI'])->name('getLastFiveBlogAPI');
        });

        Route::prefix('comment')->group(function (){
            Route::get('/{id}', [Commentcontroller::class, 'getAllBlogCommentAPI'])->name('getAllBlogCommentAPI');
            Route::post('/', [Commentcontroller::class, 'createBlogCommentAPI'])->name('createBlogCommentAPI');
        });

        Route::prefix('category')->group(function (){
            Route::post('', [CategoryController::class, 'createCategoryAPI'])->name('createCategoryAPI');
        });

        Route::post('message', [ContactController::class, 'createMessageAPI'])->name('createMessageAPI');
        Route::post('question', [QuestionController::class, 'createQuestionAPI'])->name('createQuestionAPI');
    });
});
