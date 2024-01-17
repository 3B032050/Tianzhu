<?php

use App\Http\Controllers\CommonSenseController;
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

Route::get('/common_senses', [App\Http\Controllers\CommonSenseController::class, 'index'])->name('common_senses.index');
Route::get('/common_senses/{commonSense}/show', [App\Http\Controllers\CommonSenseController::class, 'show'])->name('common_senses.show');
Route::get('/common_senses/{commonSense}/show_content', [App\Http\Controllers\CommonSenseController::class, 'show_content'])->name('common_senses.show_content');

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

        Route::get('/courses',[App\Http\Controllers\AdminCourseController::class,'index'])->name('courses.index');
        Route::get('/courses/create',[App\Http\Controllers\AdminCourseController::class,'create'])->name('courses.create');
        Route::post('/courses', [App\Http\Controllers\AdminCourseController::class, 'store'])->name("courses.store");
        Route::get('/courses/{course}/edit', [App\Http\Controllers\AdminCourseController::class, 'edit'])->name("courses.edit");
        Route::patch('/courses/{course}',[App\Http\Controllers\AdminCourseController::class,'update'])->name('courses.update');
        Route::delete('/courses/{course}', [App\Http\Controllers\AdminCourseController::class, 'destroy'])->name("courses.destroy");
        Route::get('/courses/search', [App\Http\Controllers\AdminCourseController::class, 'search'])->name('courses.search');

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
        #課程講義
        Route::get('/coursefile',[App\Http\Controllers\AdminCourseFileController::class,'index'])->name('course_file.index');
        Route::get('/coursefile/create',[App\Http\Controllers\AdminCourseFileController::class,'create'])->name('course_file.create');
        Route::post('/coursefile', [App\Http\Controllers\AdminCourseFileController::class, 'store'])->name("course_file.store");
        Route::get('/coursefile/{coursefile}/edit', [App\Http\Controllers\AdminCourseFileController::class, 'edit'])->name("course_file.edit");
        Route::patch('/coursefile/{coursefile}',[App\Http\Controllers\AdminCourseFileController::class,'update'])->name('course_file.update');
        Route::delete('/coursefile/{coursefile}', [App\Http\Controllers\AdminCourseFileController::class, 'destroy'])->name("course_file.destroy");

        Route::get('/curricula',[App\Http\Controllers\AdminCurriculumController::class,'index'])->name('curricula.index');
        Route::get('/curricula/create',[App\Http\Controllers\AdminCurriculumController::class,'create'])->name('curricula.create');
        Route::post('/curricula', [App\Http\Controllers\AdminCurriculumController::class, 'store'])->name("curricula.store");
        Route::get('/curricula/{curriculum}/edit', [App\Http\Controllers\AdminCurriculumController::class, 'edit'])->name("curricula.edit");
        Route::patch('/curricula/{curriculum}',[App\Http\Controllers\AdminCurriculumController::class,'update'])->name('curricula.update');
        Route::delete('/curricula/{curriculum}', [App\Http\Controllers\AdminCurriculumController::class, 'destroy'])->name("curricula.destroy");
        Route::get('/curricula/search', [App\Http\Controllers\AdminCurriculumController::class, 'search'])->name('curricula.search');

        Route::get('/curriculum_objectives',[App\Http\Controllers\AdminCurriculumObjectiveController::class,'index'])->name('curriculum_objectives.index');
        Route::get('/curriculum_objectives/create',[App\Http\Controllers\AdminCurriculumObjectiveController::class,'create'])->name('curriculum_objectives.create');
        Route::post('/curriculum_objectives', [App\Http\Controllers\AdminCurriculumObjectiveController::class, 'store'])->name("curriculum_objectives.store");
        Route::get('/curriculum_objectives/{curriculum_objective}/edit', [App\Http\Controllers\AdminCurriculumObjectiveController::class, 'edit'])->name("curriculum_objectives.edit");
        Route::patch('/curriculum_objectives/{curriculum_objective}',[App\Http\Controllers\AdminCurriculumObjectiveController::class,'update'])->name('curriculum_objectives.update');
        Route::delete('/curriculum_objectives/{curriculum_objective}', [App\Http\Controllers\AdminCurriculumObjectiveController::class, 'destroy'])->name("curriculum_objectives.destroy");
        Route::get('/curriculum_objectives/search', [App\Http\Controllers\AdminCurriculumObjectiveController::class, 'search'])->name('curriculum_objectives.search');

        Route::get('/curriculum_categories',[App\Http\Controllers\AdminCurriculumCategoryController::class,'index'])->name('curriculum_categories.index');
        Route::get('/curriculum_categories/create',[App\Http\Controllers\AdminCurriculumCategoryController::class,'create'])->name('curriculum_categories.create');
        Route::post('/curriculum_categories', [App\Http\Controllers\AdminCurriculumCategoryController::class, 'store'])->name("curriculum_categories.store");
        Route::get('/curriculum_categories/{curriculum_category}/edit', [App\Http\Controllers\AdminCurriculumCategoryController::class, 'edit'])->name("curriculum_categories.edit");
        Route::patch('/curriculum_categories/{curriculum_category}',[App\Http\Controllers\AdminCurriculumCategoryController::class,'update'])->name('curriculum_categories.update');
        Route::delete('/curriculum_categories/{curriculum_category}', [App\Http\Controllers\AdminCurriculumCategoryController::class, 'destroy'])->name("curriculum_categories.destroy");
        Route::get('/curriculum_categories/search', [App\Http\Controllers\AdminCurriculumCategoryController::class, 'search'])->name('curriculum_categories.search');

        Route::get('/curriculum_methods',[App\Http\Controllers\AdminCurriculumMethodController::class,'index'])->name('curriculum_methods.index');
        Route::get('/curriculum_methods/create',[App\Http\Controllers\AdminCurriculumMethodController::class,'create'])->name('curriculum_methods.create');
        Route::post('/curriculum_methods', [App\Http\Controllers\AdminCurriculumMethodController::class, 'store'])->name("curriculum_methods.store");
        Route::get('/curriculum_methods/{curriculum_method}/edit', [App\Http\Controllers\AdminCurriculumMethodController::class, 'edit'])->name("curriculum_methods.edit");
        Route::patch('/curriculum_methods/{curriculum_method}',[App\Http\Controllers\AdminCurriculumMethodController::class,'update'])->name('curriculum_methods.update');
        Route::delete('/curriculum_methods/{curriculum_method}', [App\Http\Controllers\AdminCurriculumMethodController::class, 'destroy'])->name("curriculum_methods.destroy");
        Route::get('/curriculum_methods/search', [App\Http\Controllers\AdminCurriculumMethodController::class, 'search'])->name('curriculum_methods.search');

        Route::get('/common_senses',[App\Http\Controllers\AdminCommonSenseController::class,'index'])->name('common_senses.index');
        Route::get('/common_senses/create',[App\Http\Controllers\AdminCommonSenseController::class,'create'])->name('common_senses.create');
        Route::post('/common_senses', [App\Http\Controllers\AdminCommonSenseController::class, 'store'])->name("common_senses.store");
        Route::get('/common_senses/{common_sense}/edit', [App\Http\Controllers\AdminCommonSenseController::class, 'edit'])->name("common_senses.edit");
        Route::patch('/common_senses/{common_sense}',[App\Http\Controllers\AdminCommonSenseController::class,'update'])->name('common_senses.update');
        Route::delete('/common_senses/{common_sense}', [App\Http\Controllers\AdminCommonSenseController::class, 'destroy'])->name("common_senses.destroy");
        Route::get('/common_senses/search', [App\Http\Controllers\AdminCommonSenseController::class, 'search'])->name('common_senses.search');

        Route::get('/common_sense_categories',[App\Http\Controllers\AdminCommonSenseCategoryController::class,'index'])->name('common_sense_categories.index');
        Route::get('/common_sense_categories/create',[App\Http\Controllers\AdminCommonSenseCategoryController::class,'create'])->name('common_sense_categories.create');
        Route::post('/common_sense_categories', [App\Http\Controllers\AdminCommonSenseCategoryController::class, 'store'])->name("common_sense_categories.store");
        Route::get('/common_sense_categories/{common_sense_category}/edit', [App\Http\Controllers\AdminCommonSenseCategoryController::class, 'edit'])->name("common_sense_categories.edit");
        Route::patch('/common_sense_categories/{common_sense_category}',[App\Http\Controllers\AdminCommonSenseCategoryController::class,'update'])->name('common_sense_categories.update');
        Route::delete('/common_sense_categories/{common_sense_category}', [App\Http\Controllers\AdminCommonSenseCategoryController::class, 'destroy'])->name("common_sense_categories.destroy");
        Route::get('/common_sense_categories/search', [App\Http\Controllers\AdminCommonSenseCategoryController::class, 'search'])->name('common_sense_categories.search');

    });
});

