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

//routes for category

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

//end routes for category


//routes for faq

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


//routes for comptes admin

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
