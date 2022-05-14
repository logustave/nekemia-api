<?php

use App\Http\Controllers\v1\AdminController;
use Djunehor\Sms\Concrete\RingCaptcha;
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
    return view('welcome');
});

Route::get('/verified-email/{id}/{token}', [AdminController::class, 'verifiedAdminEmail'])->name('verified-email');

Route::get('sendSms', function (){
    $response = Http::post('https://api.ringcaptcha.com/y7u4yji7efy2ohe8y2y4/code/sms', [
        'phone'=>2250584443227,
        'api_key'=>'9f2b039d02e06643ebd69c2d683af11b72bf572f'
    ]);
    dd($response);
});
