<?php

use App\Http\Controllers\v1\AdminController;
use Djunehor\Sms\Concrete\RingCaptcha;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
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
    return view('index');
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
    Route::get('/',function (){
        return view('pages.categorie.index');
    });
    Route::get('/information/{id}', function () {
        return view('pages.categorie.information');
    });
    Route::get('/modifier/{id}', function () {
        return view('pages.categorie.modifier');
    });
});

Route::prefix('/faq')->group(function (){
    Route::get('/',function (){
        return view('pages.faq.index');
    });
    Route::get('/information/{id}', function () {
        return view('pages.faq.information');
    });
    Route::get('/modifier/{id}', function () {
        return view('pages.categorie.modifier');
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
