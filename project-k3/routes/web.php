<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;

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


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('login/store', [LoginController::class, 'store'])->name('store');

Route::middleware(['auth'])->group(function() {
    Route::get('logout', [MainController::class, 'logout'])->name('logout');
   
    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'main'])->name('admin');
       
        Route::prefix('users')->group(function (){
            Route::get('/', [UserController::class, 'list_user'])->name('list-users');

            //create
            Route::get('/create', [UserController::class, 'create'])->name('create-user');
            Route::post('/store', [UserController::class, 'store'])->name('store-user');

            //edit
            Route::get('/update/{id}', [UserController::class, 'edit'])->name('edit-user');
            Route::post('/update/{id}', [UserController::class, 'update'])->name('update-user');

            //show
            Route::get('/show/{id}', [UserController::class, 'show'])->name('show-user');

            //delete
            Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete-user');

            //delected users
            Route::get('/deleted', [UserController::class, 'deleted'])->name('deleted-users');
            Route::get('/restore/{id}', [UserController::class, 'restore'])->name('restore-user');
            Route::get('/permanently/{id}', [UserController::class, 'forceDelete'])->name('permanently-user');

        });

        Route::prefix('categories')->group(function (){
            Route::get('/', [CategoryController::class, 'list_categories'])->name('list-categories');

           //create
           Route::get('/create', [CategoryController::class, 'create'])->name('create-category');
           Route::get('/chang-status/{id}', [CategoryController::class, 'changStatus'])->name('admin.category.status');
           Route::post('/store', [CategoryController::class, 'store'])->name('store-category');

           //edit
           Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit-category');
           Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update-category');

           //show
           Route::get('/show/{id}', [CategoryController::class, 'show'])->name('show-category');

           //delete
           Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('delete-category');

             //delected Categories
            Route::get('/deleted', [CategoryController::class, 'deleted'])->name('deleted-categories');
            Route::get('/restore/{id}', [CategoryController::class, 'restore'])->name('restore-category');
            Route::get('/permanently/{id}', [CategoryController::class, 'forceDelete'])->name('permanently-category');

        });

        Route::prefix('posts')->group(function (){
            Route::get('/', [PostController::class, 'list_posts'])->name('list-posts');
            Route::get('/chang-status/{id}', [PostController::class, 'changStatus'])->name('admin.post.status');
           //create
            Route::get('/create', [PostController::class, 'create'])->name('create-post');
            Route::post('/store', [PostController::class, 'store'])->name('store-post');

           //edit
           Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit-post');
           Route::post('/update/{id}', [PostController::class, 'update'])->name('update-post');

           //show
           Route::get('/show/{id}', [PostController::class, 'show'])->name('show-post');

           //delete
           Route::get('/delete/{id}', [PostController::class, 'delete'])->name('delete-post');

            //delected Posts
            Route::get('/deleted', [PostController::class, 'deleted'])->name('deleted-posts');
            Route::get('/restore/{id}', [PostController::class, 'restore'])->name('restore-post');
            Route::get('/permanently/{id}', [PostController::class, 'forceDelete'])->name('permanently-post');

            //export
            Route::get('/exportcsv/{id}', [PostController::class, 'exportPostCSV'])->name('export.csv.post')->middleware('checkrole:admin,manager');
            Route::get('/exportxlsx/{id}', [PostController::class, 'exportPostXlsx'])->name('export.xlsx.post')->middleware('checkrole:admin,manager');
            
            //import
            Route::post('/importcsv', [PostController::class, 'importPostCsv'])->name('import.csv.post')->middleware('checkrole:manager');

        });

    });//admin
});//middleware
// Route::get('/exportcsv/{id}', [PostController::class, 'exportPostCSV'])->name('export.csv.post')->middleware('checkrole:admin,manager');
// Route::get('/exportxlsx/{id}', [PostController::class, 'exportPostXlsx'])->name('export.xlsx.post')->middleware('checkrole:admin,manager');
// Route::post('/importcsv', [PostController::class, 'importCsvPost'])->name('import.csv.post')->middleware('checkrole:admin,manager');
Route::get('/', function(){
   return view('admin.auth.login');
});
//ok