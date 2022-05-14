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

Route::get('sendSms', function (){
    $client = new Client();
    $res = $client->request('post', "https://api.ringcaptcha.com/y7u4yji7efy2ohe8y2y4/sms", [
        'headers' => [
            'Accept' => 'application/json',
        ],
        'form_params' => [
            "app_key"=> 'y7u4yji7efy2ohe8y2y4',
            "api_key"=>'9f2b039d02e06643ebd69c2d683af11b72bf572f',
            "phone"=>"+22584443227",
            'message' => "Code de vérification Nekemia BTP: {{ code }}.",
        ]
    ]);
    dd($res->getBody()->getContents());
});

//routes for category

Route::prefix('/category')->group(function (){
    Route::get('/',function (){
        return view('pages.category.index');
    });
    Route::get('/information/{id}', function () {
        return view('pages.category.information');
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
        return view('pages.category.information');
    });
});
