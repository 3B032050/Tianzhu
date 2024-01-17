<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/web/{web_id}', [App\Http\Controllers\WebController::class, 'index'])->name('web.index');

//Route::get('/select','TestController@testfunction');
Route::get('/select', [App\Http\Controllers\AdminAdminController::class, 'search'])->name("admins.search");

Route::get('/courses', [App\Http\Controllers\CourseController::class, 'overview'])->name('courses.overview');
Route::get('/courses/by_category/{course_category}', [App\Http\Controllers\CourseController::class, 'by_category'])->name('courses.by_category');
Route::get('/courses/by_category/{course_category}/show/{course}', [App\Http\Controllers\CourseController::class, 'show'])->name('courses.show');

Route::get('/activities', [App\Http\Controllers\ActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/{activity}/show', [App\Http\Controllers\ActivityController::class, 'show'])->name('activities.show');




Auth::routes();

//會員資料
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/',[App\Http\Controllers\UserController::class,'index'])->name('index');
        Route::patch('{user}',[App\Http\Controllers\UserController::class,'update'])->name('update');
        Route::post('/comment', [App\Http\Controllers\PostCommentController::class, 'store'])->name("comment.store");
        Route::get('/comment/{id}', [App\Http\Controllers\PostCommentController::class, 'edit'])->name('commnet.edit');
        Route::patch('/comment', [App\Http\Controllers\PostCommentController::class, 'update'])->name('commnet.update');
        Route::delete('/comment', [App\Http\Controllers\PostCommentController::class, 'destroy'])->name('commnet.destroy');
    });

});


//管理員後台管理
Route::group(['middleware' => 'admin'], function(){
    Route::prefix('admins')->name('admins.')->group(function () {
        Route::get('/',[App\Http\Controllers\AdminController::class,'dashboard']);
        Route::get('/dashboard',[App\Http\Controllers\AdminController::class,'dashboard'])->name('dashboard');
        Route::get('/home',[App\Http\Controllers\AdminController::class,'home'])->name('home.index');

        Route::get('/web_hierarchies',[App\Http\Controllers\AdminWebHierarchyController::class,'index'])->name('web_hierarchies.index');
        Route::get('/web_hierarchies/create/{web_id}',[App\Http\Controllers\AdminWebHierarchyController::class,'create'])->name('web_hierarchies.create');
        Route::post('/web_hierarchies', [App\Http\Controllers\AdminWebHierarchyController::class, 'store'])->name("web_hierarchies.store");
        Route::get('/web_hierarchies/{web_hierarchy}/edit', [App\Http\Controllers\AdminWebHierarchyController::class, 'edit'])->name("web_hierarchies.edit");
        Route::patch('/web_hierarchies/{web_hierarchy}',[App\Http\Controllers\AdminWebHierarchyController::class,'update'])->name('web_hierarchies.update');
        Route::delete('/web_hierarchies/{web_hierarchy}', [App\Http\Controllers\AdminWebHierarchyController::class, 'destroy'])->name("web_hierarchies.destroy");

        Route::get('/web_contents',[App\Http\Controllers\AdminWebContentController::class,'index'])->name('web_contents.index');
        Route::get('/web_contents/create/{web_id}',[App\Http\Controllers\AdminWebContentController::class,'create'])->name('web_contents.create');
        Route::post('/web_contents', [App\Http\Controllers\AdminWebContentController::class, 'store'])->name("web_contents.store");
        Route::get('/web_contents/{web_content}/edit', [App\Http\Controllers\AdminWebContentController::class, 'edit'])->name("web_contents.edit");
        Route::patch('/web_contents/{web_content}',[App\Http\Controllers\AdminWebContentController::class,'update'])->name('web_contents.update');
        Route::delete('/web_contents/{web_content}', [App\Http\Controllers\AdminWebContentController::class, 'destroy'])->name("web_contents.destroy");
        Route::post('/web_contents/upload', [App\Http\Controllers\AdminWebContentController::class, 'upload'])->name('web_contents.upload');

        Route::get('/users',[App\Http\Controllers\AdminUserController::class,'index'])->name('users.index');
        Route::get('/users/create',[App\Http\Controllers\AdminUserController::class,'create'])->name('users.create');
        Route::post('/users', [App\Http\Controllers\AdminUserController::class, 'store'])->name("users.store");
        Route::get('/users/{user}/edit', [App\Http\Controllers\AdminUserController::class, 'edit'])->name("users.edit");
        Route::patch('/users/{user}',[App\Http\Controllers\AdminUserController::class,'update'])->name('users.update');
        Route::delete('/users/{user}', [App\Http\Controllers\AdminUserController::class, 'destroy'])->name("users.destroy");
        Route::get('/users/search', [App\Http\Controllers\AdminUserController::class, 'search'])->name('users.search');

        Route::get('/course_overviews/edit', [App\Http\Controllers\AdminCourseOverviewController::class, 'edit'])->name("course_overviews.edit");
        Route::patch('/course_overviews/{course_overview}',[App\Http\Controllers\AdminCourseOverviewController::class,'update'])->name('course_overviews.update');
        Route::post('/course_overviews/upload', [App\Http\Controllers\AdminCourseOverviewController::class, 'upload'])->name('course_overviews.upload');


        Route::get('/courses',[App\Http\Controllers\AdminCourseController::class,'index'])->name('courses.index');
        Route::get('/courses/create',[App\Http\Controllers\AdminCourseController::class,'create'])->name('courses.create');
        Route::post('/courses', [App\Http\Controllers\AdminCourseController::class, 'store'])->name("courses.store");
        Route::get('/courses/{course}/edit', [App\Http\Controllers\AdminCourseController::class, 'edit'])->name("courses.edit");
        Route::patch('/courses/{course}',[App\Http\Controllers\AdminCourseController::class,'update'])->name('courses.update');
        Route::delete('/courses/{course}', [App\Http\Controllers\AdminCourseController::class, 'destroy'])->name("courses.destroy");
        Route::get('/courses/search', [App\Http\Controllers\AdminCourseController::class, 'search'])->name('courses.search');
        Route::post('/courses/upload', [App\Http\Controllers\AdminCourseController::class, 'upload'])->name('courses.upload');


        Route::get('/course_objectives',[App\Http\Controllers\AdminCourseObjectiveController::class,'index'])->name('course_objectives.index');
        Route::get('/course_objectives/create',[App\Http\Controllers\AdminCourseObjectiveController::class,'create'])->name('course_objectives.create');
        Route::post('/course_objectives', [App\Http\Controllers\AdminCourseObjectiveController::class, 'store'])->name("course_objectives.store");
        Route::get('/course_objectives/{course_objective}/edit', [App\Http\Controllers\AdminCourseObjectiveController::class, 'edit'])->name("course_objectives.edit");
        Route::patch('/course_objectives/{course_objective}',[App\Http\Controllers\AdminCourseObjectiveController::class,'update'])->name('course_objectives.update');
        Route::delete('/course_objectives/{course_objective}', [App\Http\Controllers\AdminCourseObjectiveController::class, 'destroy'])->name("course_objectives.destroy");
        Route::get('/course_objectives/search', [App\Http\Controllers\AdminCourseObjectiveController::class, 'search'])->name('course_objectives.search');

        Route::get('/course_categories',[App\Http\Controllers\AdminCourseCategoryController::class,'index'])->name('course_categories.index');
        Route::get('/course_categories/create',[App\Http\Controllers\AdminCourseCategoryController::class,'create'])->name('course_categories.create');
        Route::post('/course_categories', [App\Http\Controllers\AdminCourseCategoryController::class, 'store'])->name("course_categories.store");
        Route::get('/course_categories/{course_category}/edit', [App\Http\Controllers\AdminCourseCategoryController::class, 'edit'])->name("course_categories.edit");
        Route::patch('/course_categories/{course_category}',[App\Http\Controllers\AdminCourseCategoryController::class,'update'])->name('course_categories.update');
        Route::delete('/course_categories/{course_category}', [App\Http\Controllers\AdminCourseCategoryController::class, 'destroy'])->name("course_categories.destroy");
        Route::get('/course_categories/search', [App\Http\Controllers\AdminCourseCategoryController::class, 'search'])->name('course_categories.search');

        Route::get('/course_methods',[App\Http\Controllers\AdminCourseMethodController::class,'index'])->name('course_methods.index');
        Route::get('/course_methods/create',[App\Http\Controllers\AdminCourseMethodController::class,'create'])->name('course_methods.create');
        Route::post('/course_methods', [App\Http\Controllers\AdminCourseMethodController::class, 'store'])->name("course_methods.store");
        Route::get('/course_methods/{course_method}/edit', [App\Http\Controllers\AdminCourseMethodController::class, 'edit'])->name("course_methods.edit");
        Route::patch('/course_methods/{course_method}',[App\Http\Controllers\AdminCourseMethodController::class,'update'])->name('course_methods.update');
        Route::delete('/course_methods/{course_method}', [App\Http\Controllers\AdminCourseMethodController::class, 'destroy'])->name("course_methods.destroy");
        Route::get('/course_methods/search', [App\Http\Controllers\AdminCourseMethodController::class, 'search'])->name('course_methods.search');

        Route::get('/activities',[App\Http\Controllers\AdminActivityController::class,'index'])->name('activities.index');
        Route::get('/activities/create',[App\Http\Controllers\AdminActivityController::class,'create'])->name('activities.create');
        Route::post('/activities', [App\Http\Controllers\AdminActivityController::class, 'store'])->name("activities.store");
        Route::get('/activities/{activity}/edit', [App\Http\Controllers\AdminActivityController::class, 'edit'])->name("activities.edit");
        Route::patch('/activities/{activity}',[App\Http\Controllers\AdminActivityController::class,'update'])->name('activities.update');
        Route::delete('/activities/{activity}', [App\Http\Controllers\AdminActivityController::class, 'destroy'])->name("activities.destroy");
        Route::get('/activities/search', [App\Http\Controllers\AdminActivityController::class, 'search'])->name('activities.search');
        Route::post('/activities/upload', [App\Http\Controllers\AdminActivityController::class, 'upload'])->name('activities.upload');


        //公告路由
        Route::get('posts', [App\Http\Controllers\AdminPostController::class, 'index'])->name("posts.index");
        Route::get('posts/create', [App\Http\Controllers\AdminPostController::class, 'create'])->name("posts.create");
        Route::post('posts', [App\Http\Controllers\AdminPostController::class, 'store'])->name("posts.store");
        Route::get('posts/{post}/edit', [App\Http\Controllers\AdminPostController::class, 'edit'])->name("posts.edit");
        Route::patch('posts/{post}', [App\Http\Controllers\AdminPostController::class, 'update'])->name("posts.update");
        Route::delete('posts/{post}', [App\Http\Controllers\AdminPostController::class, 'destroy'])->name("posts.destroy");


        //管理員操作路由
        Route::get('/admins',[App\Http\Controllers\AdminAdminController::class,'index'])->name('admins.index');
        Route::get('/admins/create',[App\Http\Controllers\AdminAdminController::class,'create'])->name('admins.create');
        Route::get('/admins/create_selected/{id}',[App\Http\Controllers\AdminAdminController::class,'create_selcted'])->name('admins.create_selected');
        Route::post('/admins', [App\Http\Controllers\AdminAdminController::class, 'store'])->name("admins.store");
        Route::post('/admins', [App\Http\Controllers\AdminAdminController::class, 'store_level'])->name("admins.store_level");
        Route::get('/admins/{admin}/edit', [App\Http\Controllers\AdminAdminController::class, 'edit'])->name("admins.edit");
        Route::patch('/admins/{admin}',[App\Http\Controllers\AdminAdminController::class,'update'])->name('admins.update');
        Route::delete('/admins/{admin}', [App\Http\Controllers\AdminAdminController::class, 'destroy'])->name("admins.destroy");


        Route::get('/slides', [App\Http\Controllers\AdminSlideController::class, 'index'])->name('slides.index');
        Route::get('/slides/create', [App\Http\Controllers\AdminSlideController::class, 'create'])->name('slides.create');
        Route::post('/slides', [App\Http\Controllers\AdminSlideController::class, 'store'])->name('slides.store');
        Route::get('/slides/{slide}/edit', [App\Http\Controllers\AdminSlideController::class, 'edit'])->name("slides.edit");
        Route::patch('/slides/{slide}',[App\Http\Controllers\AdminSlideController::class,'update'])->name('slides.update');
        Route::delete('/slides/{slide}', [App\Http\Controllers\AdminSlideController::class, 'destroy'])->name("slides.destroy");
        Route::patch('/slides/{slide}/update_order', [App\Http\Controllers\AdminSlideController::class, 'update_order'])->name('slides.update_order');
    });
});



