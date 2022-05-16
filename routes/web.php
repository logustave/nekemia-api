<?php

use App\Http\Controllers\v1\AdminController;
use Djunehor\Sms\Concrete\RingCaptcha;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\CategoryController;
use App\Http\Controllers\v1\FaqController;
use App\Http\Controllers\v1\BlogController;
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

Route::prefix("/")->group(function (){
    Route::get('/',function (){
        return View('index');
    });
    Route::get('dashboard',function (){
        return View('index');
    })->name('acceuil');
});

Route::get('/verified-email/{id}/{token}', [AdminController::class, 'verifiedAdminEmail'])->name('verified-email');

Route::prefix('administrateur')->group(function (){
    Route::get('/', [AdminController::class, '']);
    Route::get('{id}', [AdminController::class, '']);
    Route::post('/', [AdminController::class, '']);
    Route::get('/update', [AdminController::class, '']);
    Route::put('/update/details', [AdminController::class, '']);
    Route::put('/update/password', [AdminController::class, '']);
    Route::put('/update/email', [AdminController::class, '']);
});

Route::prefix('/categorie')->group(function (){

    Route::controller(CategoryController::class)->group(function () {

        #pages
        Route::get('/','index' );
        Route::get('/information/{id}','show')->name("seeCategory");
        Route::get('/modifier/{id}','edit' )->name("pageEditCategory");
        #End pages

        #crud
        Route::post('/ajouter','create') ->name("createCategory");
        Route::post('/update','update') ->name("editCategory");
        Route::get('/delete/{id}','destroy')->name("deleteCategory");
        #End crud

    });
});

Route::prefix('/faq')->group(function (){
    Route::controller(FaqController::class)->group(function (){
        #pages
        Route::get('/','index');
        Route::get('/information/{id}','show')->name("seeFaq");
        Route::get('/modifier/{id}','edit' )->name("pageEditFaq");
        #End pages

        #crud
        Route::post('/ajouter','create') ->name("createFaq");
        Route::post('/update','update') ->name("editFAq");
        Route::get('/delete/{id}','destroy')->name("deleteFAq");
        #End crud
    });

});

Route::prefix('/blog')->group(function (){
    Route::controller(BlogController::class)->group(function (){
        #pages
        Route::get('/','index');
        Route::get('/information/{id}','show')->name("seeBlog");
        Route::get('/modifier/{id}','edit' )->name("pageEditBlog");
        #End pages

        #crud
        Route::post('/ajouter','create') ->name("createBlog");
        Route::post('/update','update') ->name("editBLog");
        Route::get('/delete/{id}','destroy')->name("deleteBlog");
        #End crud
    });

});


Route::prefix('/comptes')->group(function (){
    Route::get('/',function (){
        return view('pages.comptes.index');
    });
});


Route::prefix('/profile')->group(function (){
    Route::get('/',function (){
        return view('pages.profile.index');
    });
    Route::get('/modifier/{id}', function () {
        return view('pages.profile.modifier');
    });
});
