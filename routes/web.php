<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPostsController;
use App\Http\Controllers\AdminAdminsController;
use App\Http\Controllers\AdminWebHierarchiesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//回首頁
Route::get('/', function () {
    return view('index');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Auth::routes();

//會員資料
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/',[App\Http\Controllers\UserController::class,'index'])->name('index');
    Route::patch('{user}',[App\Http\Controllers\UserController::class,'update'])->name('update');
});

//管理員後台管理
Route::group(['middleware' => 'admin'], function(){
    Route::prefix('admins')->name('admins.')->group(function () {
        Route::get('/',[App\Http\Controllers\AdminController::class,'dashboard']);
        Route::get('/dashboard',[App\Http\Controllers\AdminController::class,'dashboard'])->name('dashboard');
        Route::get('/home',[App\Http\Controllers\AdminController::class,'home'])->name('home.index');

        Route::get('/web_hierarchies',[App\Http\Controllers\AdminWebHierarchiesController::class,'index'])->name('web_hierarchies.index');
        Route::get('/web_hierarchies/create',[App\Http\Controllers\AdminWebHierarchiesController::class,'create'])->name('web_hierarchies.create');
        Route::post('/web_hierarchies', [App\Http\Controllers\AdminWebHierarchiesController::class, 'store'])->name("web_hierarchies.store");
        Route::get('/web_hierarchies/{web_hierarchy}/edit', [App\Http\Controllers\AdminWebHierarchiesController::class, 'edit'])->name("web_hierarchies.edit");
        Route::patch('/web_hierarchies/{web_hierarchy}',[App\Http\Controllers\AdminWebHierarchiesController::class,'update'])->name('web_hierarchies.update');
        Route::delete('/web_hierarchies/{web_hierarchy}', [App\Http\Controllers\AdminWebHierarchiesController::class, 'destroy'])->name("web_hierarchies.destroy");

        Route::get('/users',[App\Http\Controllers\AdminUsersController::class,'index'])->name('users.index');
        Route::get('/users/create',[App\Http\Controllers\AdminUsersController::class,'create'])->name('users.create');
        Route::post('/users', [App\Http\Controllers\AdminUsersController::class, 'store'])->name("users.store");
        Route::get('/users/{user}/edit', [App\Http\Controllers\AdminUsersController::class, 'edit'])->name("users.edit");
        Route::patch('/users/{user}',[App\Http\Controllers\AdminUsersController::class,'update'])->name('users.update');
        Route::delete('/users/{user}', [App\Http\Controllers\AdminUsersController::class, 'destroy'])->name("users.destroy");

        Route::get('/posts',[App\Http\Controllers\AdminPostsController::class,'index'])->name('posts.index');
        Route::get('/posts/create',[App\Http\Controllers\AdminPostsController::class,'create'])->name('posts.create');
        Route::get('/posts/{post}',[App\Http\Controllers\AdminPostsController::class,'update'])->name('posts.update');

        Route::get('/admins',[App\Http\Controllers\AdminAdminsController::class,'index'])->name('admins.index');
        Route::get('/admins/create',[App\Http\Controllers\AdminAdminsController::class,'create'])->name('admins.create');
        Route::get('/admins/create_selected',[App\Http\Controllers\AdminAdminsController::class,'create'])->name('admins.create_selected');
        Route::post('/admins', [App\Http\Controllers\AdminAdminsController::class, 'store'])->name("admins.store");
        Route::get('/admins/{admin}/edit', [App\Http\Controllers\AdminAdminsController::class, 'edit'])->name("admins.edit");
        Route::patch('/admins/{admin}',[App\Http\Controllers\AdminAdminsController::class,'update'])->name('admins.update');
        Route::delete('/admins/{admin}', [App\Http\Controllers\AdminAdminsController::class, 'destroy'])->name("admins.destroy");

    });
});



