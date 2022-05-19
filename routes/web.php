<?php

use App\Http\Controllers\v1\AdminController;
use Illuminate\Support\Facades\Cookie;
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





Route::get('/verified-email/{id}/{token}', [AdminController::class, 'verifiedAdminEmail'])->name('verified-email');

Route::get("connexion",function (){
   return view("login");
});

Route::get("deconnexion",[AdminController::class, 'signOut'])->name("deconnexion");

Route::get("test",function (){
    return dd(Cookie::get());
});

Route::post('connect',[AdminController::class,"authAdmin"]) ->name("loginCompte");

Route::group(['middleware' => 'isConnected'], static function () {
    Route::get('/',[AdminController::class,'signIn']);

    Route::controller(AdminController::class)->group(function (){

        Route::get('/dashboard',function (){
            return View('index');
        })->name('acceuil');

        Route::prefix('/comptes')->group(function (){

            Route::get('/', 'index');
            Route::get('information/{id}',  'show')->name("seeAdmin");
            Route::get('/modifier/{id}','edit')->name("pageEditCompte");
            Route::get('/ajouter','store') ->name("pageAddCompte");




            Route::post('/update', 'update')->name("editAdmin");
            Route::post('/add','create') ->name("createCompte");
            Route::put('/update/password', '');
            Route::put('/update/email', '');
            Route::get('/delete/{id}','destroy') ->name("deleteCompte");

        });
    });

    Route::controller(CategoryController::class)->group(function () {

        Route::prefix('/categorie')->group(function (){
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
            Route::post('/update','update') ->name("editFaq");
            Route::get('/delete/{id}','destroy')->name("deleteFaq");
            #End crud
        });

    });

    Route::prefix('/blog')->group(function (){
        Route::controller(BlogController::class)->group(function (){
            #pages
            Route::get('/','index');
            Route::get('/information/{slug}','show')->name("seeBlog");
            Route::get('/modifier/{slug}','edit' )->name("pageEditBlog");
            Route::get('/ajouter','store') ->name("pageAddBlog");

            #End pages

            #crud
            Route::post('/add','create') ->name("createBlog");
            Route::post('/update','update') ->name("editBLog");
            Route::get('/delete/{id}','destroy')->name("deleteBlog");
            #End crud
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


});




