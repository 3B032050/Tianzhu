<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPostsController;
use App\Http\Controllers\AdminAdminsController;
use App\Http\Controllers\AdminWebHierarchiesController;
use App\Http\Controllers\WebController;

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
//Route::get('/', function () {
//    return view('index');
//});
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('show');
Route::get('/post/{id}/{file}', [App\Http\Controllers\PostController::class, 'post_download'])->name('post_download');
Route::get('/web', [App\Http\Controllers\WebController::class, 'index'])->name('web.index');


Auth::routes();

//會員資料
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/',[App\Http\Controllers\UserController::class,'index'])->name('index');
        Route::patch('{user}',[App\Http\Controllers\UserController::class,'update'])->name('update');
    });
});


//管理員後台管理
Route::group(['middleware' => 'admin'], function(){
    Route::prefix('admins')->name('admins.')->group(function () {
        Route::get('/',[App\Http\Controllers\AdminController::class,'dashboard']);
        Route::get('/dashboard',[App\Http\Controllers\AdminController::class,'dashboard'])->name('dashboard');
        Route::get('/home',[App\Http\Controllers\AdminController::class,'home'])->name('home.index');

        Route::get('/web_hierarchies',[App\Http\Controllers\AdminWebHierarchiesController::class,'index'])->name('web_hierarchies.index');
        Route::get('/web_hierarchies/create/{web_id}',[App\Http\Controllers\AdminWebHierarchiesController::class,'create'])->name('web_hierarchies.create');
        Route::post('/web_hierarchies', [App\Http\Controllers\AdminWebHierarchiesController::class, 'store'])->name("web_hierarchies.store");
        Route::get('/web_hierarchies/{web_hierarchy}/edit', [App\Http\Controllers\AdminWebHierarchiesController::class, 'edit'])->name("web_hierarchies.edit");
        Route::patch('/web_hierarchies/{web_hierarchy}',[App\Http\Controllers\AdminWebHierarchiesController::class,'update'])->name('web_hierarchies.update');
        Route::delete('/web_hierarchies/{web_hierarchy}', [App\Http\Controllers\AdminWebHierarchiesController::class, 'destroy'])->name("web_hierarchies.destroy");

        Route::get('/web_contents',[App\Http\Controllers\AdminWebContentsController::class,'index'])->name('web_contents.index');
        Route::get('/web_contents/create/{web_id}',[App\Http\Controllers\AdminWebContentsController::class,'create'])->name('web_contents.create');
        Route::post('/web_contents', [App\Http\Controllers\AdminWebContentsController::class, 'store'])->name("web_contents.store");
        Route::get('/web_contents/{web_content}/edit', [App\Http\Controllers\AdminWebContentsController::class, 'edit'])->name("web_contents.edit");
        Route::patch('/web_contents/{web_content}',[App\Http\Controllers\AdminWebContentsController::class,'update'])->name('web_contents.update');
        Route::delete('/web_contents/{web_content}', [App\Http\Controllers\AdminWebContentsController::class, 'destroy'])->name("web_contents.destroy");

        Route::get('/users',[App\Http\Controllers\AdminUsersController::class,'index'])->name('users.index');
        Route::get('/users/create',[App\Http\Controllers\AdminUsersController::class,'create'])->name('users.create');
        Route::post('/users', [App\Http\Controllers\AdminUsersController::class, 'store'])->name("users.store");
        Route::get('/users/{user}/edit', [App\Http\Controllers\AdminUsersController::class, 'edit'])->name("users.edit");
        Route::patch('/users/{user}',[App\Http\Controllers\AdminUsersController::class,'update'])->name('users.update');
        Route::delete('/users/{user}', [App\Http\Controllers\AdminUsersController::class, 'destroy'])->name("users.destroy");

        //公告路由
        Route::get('posts', [App\Http\Controllers\AdminPostsController::class, 'index'])->name("posts.index");
        Route::get('posts/create', [App\Http\Controllers\AdminPostsController::class, 'create'])->name("posts.create");
        Route::post('posts', [App\Http\Controllers\AdminPostsController::class, 'store'])->name("posts.store");
        Route::get('posts/{post}/edit', [App\Http\Controllers\AdminPostsController::class, 'edit'])->name("posts.edit");
        Route::patch('posts/{post}', [App\Http\Controllers\AdminPostsController::class, 'update'])->name("posts.update");
        Route::delete('posts/{post}', [App\Http\Controllers\AdminPostsController::class, 'destroy'])->name("posts.destroy");


        //管理員操作路由
        Route::get('/admins',[App\Http\Controllers\AdminAdminsController::class,'index'])->name('admins.index');
        Route::get('/admins/create',[App\Http\Controllers\AdminAdminsController::class,'create'])->name('admins.create');
        Route::get('/admins/create_selected/{id}',[App\Http\Controllers\AdminAdminsController::class,'create_selcted'])->name('admins.create_selected');
        Route::post('/admins', [App\Http\Controllers\AdminAdminsController::class, 'store'])->name("admins.store");
        Route::post('/admins', [App\Http\Controllers\AdminAdminsController::class, 'store_level'])->name("admins.store_level");
        Route::get('/admins/{admin}/edit', [App\Http\Controllers\AdminAdminsController::class, 'edit'])->name("admins.edit");
        Route::patch('/admins/{admin}',[App\Http\Controllers\AdminAdminsController::class,'update'])->name('admins.update');
        Route::delete('/admins/{admin}', [App\Http\Controllers\AdminAdminsController::class, 'destroy'])->name("admins.destroy");

    });
});



