<?php

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
    return view('pages.acceuil');
});

Route::get('/dashboard', function () {
    return view('pages.acceuil');
});

//routes for categorie

Route::prefix('/categorie')->group(function (){
    Route::get('/',function (){
        return view('pages.categorie.index');
    });
    Route::get('/information/{id}', function () {
        return view('pages.categorie.information');
    });
});

//end routes for categorie


//routes for faq

Route::prefix('/faq')->group(function (){
    Route::get('/',function (){
        return view('pages.faq.index');
    });
    Route::get('/information/{id}', function () {
        return view('pages.categorie.information');
    });
});

//end routes for faq




