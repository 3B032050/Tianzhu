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

Route::get('/post', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::get('/post/{id}/{file}', [App\Http\Controllers\PostController::class, 'post_download'])->name('posts.post_download');
Route::get('/web/{web_id}', [App\Http\Controllers\WebController::class, 'index'])->name('web.index');

//Route::get('/select','TestController@testfunction');
Route::get('/select', [App\Http\Controllers\AdminAdminController::class, 'search'])->name("admins.search");


Route::get('/introductions/{introduction}/show', [App\Http\Controllers\IntroductionController::class, 'show'])->name('introductions.show');

Route::get('/courses', [App\Http\Controllers\CourseController::class, 'overview'])->name('courses.overview');
Route::get('/courses/by_category/{course_category}', [App\Http\Controllers\CourseController::class, 'by_category'])->name('courses.by_category');
Route::get('/courses/by_category/{course_category}/search', [App\Http\Controllers\CourseController::class, 'search'])->name('courses.by_category_search');
Route::get('/courses/by_category/{course_category}/show/{course}', [App\Http\Controllers\CourseController::class, 'show'])->name('courses.show');



Route::get('/activities', [App\Http\Controllers\ActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/{activity}/show', [App\Http\Controllers\ActivityController::class, 'show'])->name('activities.show');

Route::get('/common_senses', [App\Http\Controllers\CommonSenseController::class, 'index'])->name('common_senses.index');
Route::get('/common_senses/{commonSense}/show', [App\Http\Controllers\CommonSenseController::class, 'show'])->name('common_senses.show');
Route::get('/show_content/{common_sense_id}/{common_sense_category_id}', [App\Http\Controllers\CommonSenseController::class, 'show_content'])->name('common_senses.show_content');
Route::get('/common_senses/search', [App\Http\Controllers\CommonSenseController::class, 'search'])->name('common_senses.search');
Route::get('/common_senses/{common_sense_id}/show_search_content.blade.php', [App\Http\Controllers\CommonSenseController::class, 'show_search_content'])->name('common_senses.show_search_content.blade.php');



Route::get('/curricula', [App\Http\Controllers\CurriculaController::class, 'index'])->name('curricula.index');
Route::get('/curricula/{curriculum}/show', [App\Http\Controllers\CurriculaController::class, 'show'])->name('curricula.show');
Route::get('/curricula/search', [App\Http\Controllers\CurriculaController::class, 'search'])->name('curricula.search');


Route::get('/course_file', [App\Http\Controllers\CourseFileController::class, 'index'])->name('course_file.index');
Route::get('/course_file/{category}/show', [App\Http\Controllers\CourseFileController::class, 'show'])->name('course_file.show');
Route::get('/course_file/{id}/{course_file}', [App\Http\Controllers\CourseFileController::class, 'download'])->name('course_file.download');

Route::get('/video', [App\Http\Controllers\VideoController::class, 'index'])->name('videos.index');
Route::get('/video/search', [App\Http\Controllers\VideoController::class, 'search'])->name('videos.search');
Route::get('/course_file/{category}/show', [App\Http\Controllers\CourseFileController::class, 'show'])->name('course_file.show');


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

        Route::get('/user_classifications',[App\Http\Controllers\AdminUserClassificationController::class,'index'])->name('user_classifications.index');
        Route::get('/user_classifications/create',[App\Http\Controllers\AdminUserClassificationController::class,'create'])->name('user_classifications.create');
        Route::post('/user_classifications', [App\Http\Controllers\AdminUserClassificationController::class, 'store'])->name("user_classifications.store");
        Route::get('/user_classifications/{user_classification}/edit', [App\Http\Controllers\AdminUserClassificationController::class, 'edit'])->name("user_classifications.edit");
        Route::patch('/user_classifications/{user_classification}',[App\Http\Controllers\AdminUserClassificationController::class,'update'])->name('user_classifications.update');
        Route::delete('/user_classifications/{user_classification}', [App\Http\Controllers\AdminUserClassificationController::class, 'destroy'])->name("user_classifications.destroy");
        Route::get('/user_classifications/search', [App\Http\Controllers\AdminUserClassificationController::class, 'search'])->name('user_classifications.search');

        Route::get('/introductions', [App\Http\Controllers\AdminIntroductionController::class, 'index'])->name("introductions.index");
        Route::get('/introductions/traffic', [App\Http\Controllers\AdminIntroductionController::class, 'traffic'])->name("introductions.traffic");
        Route::get('/introductions/origin', [App\Http\Controllers\AdminIntroductionController::class, 'origin'])->name("introductions.origin");
        Route::patch('/introductions/{introduction}',[App\Http\Controllers\AdminIntroductionController::class,'update'])->name('introductions.update');
        Route::post('/introductions/upload', [App\Http\Controllers\AdminIntroductionController::class, 'upload'])->name('introductions.upload');

        Route::get('/course_overviews/edit', [App\Http\Controllers\AdminCourseOverviewController::class, 'edit'])->name("course_overviews.edit");
        Route::patch('/course_overviews/{course_overview}',[App\Http\Controllers\AdminCourseOverviewController::class,'update'])->name('course_overviews.update');
        Route::post('/course_overviews/upload', [App\Http\Controllers\AdminCourseOverviewController::class, 'upload'])->name('course_overviews.upload');


        Route::get('/courses',[App\Http\Controllers\AdminCourseController::class,'index'])->name('courses.index');
        Route::get('/courses/by_category',[App\Http\Controllers\AdminCourseController::class,'by_category'])->name('courses.by_category');
        Route::get('/courses/order_by/{courseCategoryId}',[App\Http\Controllers\AdminCourseController::class,'order_by'])->name('courses.order_by');
        Route::get('/courses/create',[App\Http\Controllers\AdminCourseController::class,'create'])->name('courses.create');
        Route::post('/courses', [App\Http\Controllers\AdminCourseController::class, 'store'])->name("courses.store");
        Route::get('/courses/{course}/edit', [App\Http\Controllers\AdminCourseController::class, 'edit'])->name("courses.edit");
        Route::patch('/courses/{course}',[App\Http\Controllers\AdminCourseController::class,'update'])->name('courses.update');
        Route::patch('/courses/{course}/statusOff', [App\Http\Controllers\AdminCourseController::class, 'statusOff'])->name('courses.statusOff');
        Route::patch('/courses/{course}/statusOn', [App\Http\Controllers\AdminCourseController::class, 'statusOn'])->name('courses.statusOn');
        Route::delete('/courses/{course}', [App\Http\Controllers\AdminCourseController::class, 'destroy'])->name("courses.destroy");
        Route::get('/courses/search', [App\Http\Controllers\AdminCourseController::class, 'search'])->name('courses.search');
        Route::post('/courses/upload', [App\Http\Controllers\AdminCourseController::class, 'upload'])->name('courses.upload');
        Route::patch('/courses/{course}/update_order', [App\Http\Controllers\AdminCourseController::class, 'update_order'])->name('courses.update_order');

        Route::get('/course_objectives',[App\Http\Controllers\AdminCourseObjectiveController::class,'index'])->name('course_objectives.index');
        Route::get('/course_objectives/history',[App\Http\Controllers\AdminCourseObjectiveController::class,'history'])->name('course_objectives.history');
        Route::get('/course_objectives/create',[App\Http\Controllers\AdminCourseObjectiveController::class,'create'])->name('course_objectives.create');
        Route::post('/course_objectives', [App\Http\Controllers\AdminCourseObjectiveController::class, 'store'])->name("course_objectives.store");
        Route::get('/course_objectives/{course_objective}/edit', [App\Http\Controllers\AdminCourseObjectiveController::class, 'edit'])->name("course_objectives.edit");
        Route::get('/course_objectives/{course_objective}/action', [App\Http\Controllers\AdminCourseObjectiveController::class, 'getRecentActions'])->name("course_objectives.action");
        Route::patch('/course_objectives/{course_objective}/update',[App\Http\Controllers\AdminCourseObjectiveController::class,'update'])->name('course_objectives.update');
        Route::patch('/course_objectives/{course_objective}/destroy', [App\Http\Controllers\AdminCourseObjectiveController::class, 'destroy'])->name("course_objectives.destroy");
        Route::patch('/course_objectives/{course_objective}/restore', [App\Http\Controllers\AdminCourseObjectiveController::class, 'restore'])->name("course_objectives.restore");
        Route::get('/course_objectives/search', [App\Http\Controllers\AdminCourseObjectiveController::class, 'search'])->name('course_objectives.search');

        Route::get('/course_categories/index',[App\Http\Controllers\AdminCourseCategoryController::class,'index'])->name('course_categories.index');
        Route::get('/course_categories/history',[App\Http\Controllers\AdminCourseCategoryController::class,'history'])->name('course_categories.history');
        Route::get('/course_categories/order_by',[App\Http\Controllers\AdminCourseCategoryController::class,'order_by'])->name('course_categories.order_by');
        Route::get('/course_categories/create',[App\Http\Controllers\AdminCourseCategoryController::class,'create'])->name('course_categories.create');
        Route::post('/course_categories', [App\Http\Controllers\AdminCourseCategoryController::class, 'store'])->name("course_categories.store");
        Route::get('/course_categories/{course_category}/edit', [App\Http\Controllers\AdminCourseCategoryController::class, 'edit'])->name("course_categories.edit");
        Route::get('/course_categories/{course_category}/action', [App\Http\Controllers\AdminCourseCategoryController::class, 'getRecentActions'])->name("course_categories.action");
        Route::patch('/course_categories/{course_category}/update',[App\Http\Controllers\AdminCourseCategoryController::class,'update'])->name('course_categories.update');
        Route::patch('/course_categories/{course_category}/destroy', [App\Http\Controllers\AdminCourseCategoryController::class, 'destroy'])->name("course_categories.destroy");
        Route::patch('/course_categories/{course_category}/restore', [App\Http\Controllers\AdminCourseCategoryController::class, 'restore'])->name("course_categories.restore");
        Route::get('/course_categories/search', [App\Http\Controllers\AdminCourseCategoryController::class, 'search'])->name('course_categories.search');
        Route::patch('/course_categories/{course_category}/update_order', [App\Http\Controllers\AdminCourseCategoryController::class, 'update_order'])->name('course_categories.update_order');

        Route::get('/course_methods',[App\Http\Controllers\AdminCourseMethodController::class,'index'])->name('course_methods.index');
        Route::get('/course_methods/history',[App\Http\Controllers\AdminCourseMethodController::class,'history'])->name('course_methods.history');
        Route::get('/course_methods/create',[App\Http\Controllers\AdminCourseMethodController::class,'create'])->name('course_methods.create');
        Route::post('/course_methods', [App\Http\Controllers\AdminCourseMethodController::class, 'store'])->name("course_methods.store");
        Route::get('/course_methods/{course_method}/edit', [App\Http\Controllers\AdminCourseMethodController::class, 'edit'])->name("course_methods.edit");
        Route::get('/course_methods/{course_method}/action', [App\Http\Controllers\AdminCourseMethodController::class, 'getRecentActions'])->name("course_methods.action");
        Route::patch('/course_methods/{course_method}/update',[App\Http\Controllers\AdminCourseMethodController::class,'update'])->name('course_methods.update');
        Route::patch('/course_methods/{course_method}/destroy', [App\Http\Controllers\AdminCourseMethodController::class, 'destroy'])->name("course_methods.destroy");
        Route::patch('/course_methods/{course_method}/restore', [App\Http\Controllers\AdminCourseMethodController::class, 'restore'])->name("course_methods.restore");
        Route::get('/course_methods/search', [App\Http\Controllers\AdminCourseMethodController::class, 'search'])->name('course_methods.search');

        Route::get('/activities',[App\Http\Controllers\AdminActivityController::class,'index'])->name('activities.index');
        Route::get('/activities/create',[App\Http\Controllers\AdminActivityController::class,'create'])->name('activities.create');
        Route::post('/activities', [App\Http\Controllers\AdminActivityController::class, 'store'])->name("activities.store");
        Route::get('/activities/{activity}/edit', [App\Http\Controllers\AdminActivityController::class, 'edit'])->name("activities.edit");
        Route::patch('/activities/{activity}',[App\Http\Controllers\AdminActivityController::class,'update'])->name('activities.update');
        Route::patch('/activities/{activity}/statusOff', [App\Http\Controllers\AdminActivityController::class, 'statusOff'])->name('activities.statusOff');
        Route::patch('/activities/{activity}/statusOn', [App\Http\Controllers\AdminActivityController::class, 'statusOn'])->name('activities.statusOn');
        Route::delete('/activities/{activity}', [App\Http\Controllers\AdminActivityController::class, 'destroy'])->name("activities.destroy");
        Route::get('/activities/search', [App\Http\Controllers\AdminActivityController::class, 'search'])->name('activities.search');
        Route::post('/activities/upload', [App\Http\Controllers\AdminActivityController::class, 'upload'])->name('activities.upload');


        //公告路由
        Route::get('posts', [App\Http\Controllers\AdminPostController::class, 'index'])->name("posts.index");
        Route::get('posts/search', [App\Http\Controllers\AdminPostController::class, 'search'])->name("posts.search");
        Route::get('posts/create', [App\Http\Controllers\AdminPostController::class, 'create'])->name("posts.create");
        Route::patch('posts/{post}/statuson', [App\Http\Controllers\AdminPostController::class, 'statuson'])->name("posts.statuson");
        Route::patch('posts/{post}/statusoff', [App\Http\Controllers\AdminPostController::class, 'statusoff'])->name("posts.statusoff");
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

        Route::get('/permissions',[App\Http\Controllers\AdminPermissionController::class,'index'])->name('permissions.index');
        Route::patch('/permissions/on/{permission}', [App\Http\Controllers\AdminPermissionController::class, 'on'])->name('permissions.on');
        Route::patch('/permissions/off/{permission}', [App\Http\Controllers\AdminPermissionController::class, 'off'])->name('permissions.off');


        Route::get('/slides', [App\Http\Controllers\AdminSlideController::class, 'index'])->name('slides.index');
        Route::get('/slides/create', [App\Http\Controllers\AdminSlideController::class, 'create'])->name('slides.create');
        Route::post('/slides', [App\Http\Controllers\AdminSlideController::class, 'store'])->name('slides.store');
        Route::get('/slides/{slide}/edit', [App\Http\Controllers\AdminSlideController::class, 'edit'])->name("slides.edit");
        Route::patch('/slides/{slide}',[App\Http\Controllers\AdminSlideController::class,'update'])->name('slides.update');
        Route::delete('/slides/{slide}', [App\Http\Controllers\AdminSlideController::class, 'destroy'])->name("slides.destroy");
        Route::patch('/slides/{slide}/update_order', [App\Http\Controllers\AdminSlideController::class, 'update_order'])->name('slides.update_order');
        #課程講義
        Route::get('/coursefile',[App\Http\Controllers\AdminCourseFileController::class,'index'])->name('course_file.index');
        Route::get('/coursefile/search',[App\Http\Controllers\AdminCourseFileController::class,'search'])->name('course_file.search');
        Route::get('/coursefile/create',[App\Http\Controllers\AdminCourseFileController::class,'create'])->name('course_file.create');
        Route::post('/coursefile', [App\Http\Controllers\AdminCourseFileController::class, 'store'])->name("course_file.store");
        Route::get('/coursefile/{coursefile}/edit', [App\Http\Controllers\AdminCourseFileController::class, 'edit'])->name("course_file.edit");
        Route::patch('/coursefile/{coursefile}',[App\Http\Controllers\AdminCourseFileController::class,'update'])->name('course_file.update');
        Route::patch('/coursefile/{coursefile}/statusoff',[App\Http\Controllers\AdminCourseFileController::class,'statusoff'])->name('course_file.statusoff');
        Route::patch('/coursefile/{coursefile}/statuson',[App\Http\Controllers\AdminCourseFileController::class,'statuson'])->name('course_file.statuson');
        Route::delete('/coursefile/{coursefile}', [App\Http\Controllers\AdminCourseFileController::class, 'destroy'])->name("course_file.destroy");

        #課程講義類別
        Route::get('/course_file_category',[App\Http\Controllers\AdminCourseFileCategoryController::class,'index'])->name('course_file_categories.index');
        Route::get('/course_file_category/create',[App\Http\Controllers\AdminCourseFileCategoryController::class,'create'])->name('course_file_categories.create');
        Route::post('/course_file_category', [App\Http\Controllers\AdminCourseFileCategoryController::class, 'store'])->name("course_file_categories.store");
        Route::get('/course_file_category/{course_file_category}/edit', [App\Http\Controllers\AdminCourseFileCategoryController::class, 'edit'])->name("course_file_categories.edit");
        Route::patch('/course_file_category/{course_file_category}',[App\Http\Controllers\AdminCourseFileCategoryController::class,'update'])->name('course_file_categories.update');
        Route::delete('/course_file_category/{course_file_category}', [App\Http\Controllers\AdminCourseFileCategoryController::class, 'destroy'])->name("course_file_categories.destroy");

        #影音
        Route::get('/video',[App\Http\Controllers\AdminVideoController::class,'index'])->name('videos.index');
        Route::get('/video/order',[App\Http\Controllers\AdminVideoController::class,'order'])->name('videos.order');
        Route::get('/video/create',[App\Http\Controllers\AdminVideoController::class,'create'])->name('videos.create');
        Route::get('/video/search',[App\Http\Controllers\AdminVideoController::class,'search'])->name('videos.search');
        Route::post('/video', [App\Http\Controllers\AdminVideoController::class, 'store'])->name("videos.store");
        Route::get('/video/{video}/edit', [App\Http\Controllers\AdminVideoController::class, 'edit'])->name("videos.edit");
        Route::patch('/video/{video}',[App\Http\Controllers\AdminVideoController::class,'update'])->name('videos.update');
        Route::delete('/video/{video}', [App\Http\Controllers\AdminVideoController::class, 'destroy'])->name("videos.destroy");
        Route::patch('/video/{video}/update_order',[App\Http\Controllers\AdminVideoController::class,'update_order'])->name('videos.update_order');

        #影音類別
        Route::get('/video_category',[App\Http\Controllers\AdminVideoCategoryController::class,'index'])->name('video_categories.index');
        Route::get('/video_category/create',[App\Http\Controllers\AdminVideoCategoryController::class,'create'])->name('video_categories.create');
        Route::post('/video_category', [App\Http\Controllers\AdminVideoCategoryController::class, 'store'])->name("video_categories.store");
        Route::get('/video_category/{video_category}/edit', [App\Http\Controllers\AdminVideoCategoryController::class, 'edit'])->name("video_categories.edit");
        Route::patch('/video_category/{video_category}',[App\Http\Controllers\AdminVideoCategoryController::class,'update'])->name('video_categories.update');
        Route::delete('/video_category/{video_category}', [App\Http\Controllers\AdminVideoCategoryController::class, 'destroy'])->name("video_categories.destroy");
        Route::patch('/video_category/{video_category}/update_order',[App\Http\Controllers\AdminVideoCategoryController::class,'update_order'])->name('video_categories.update_order');

        Route::get('/curricula',[App\Http\Controllers\AdminCurriculumController::class,'index'])->name('curricula.index');
        Route::get('/curricula/by_category',[App\Http\Controllers\AdminCurriculumController::class,'by_category'])->name('curricula.by_category');
        Route::get('/curricula/order_by/{curriculumCategoryId}',[App\Http\Controllers\AdminCurriculumController::class,'order_by'])->name('curricula.order_by');
        Route::get('/curricula/create',[App\Http\Controllers\AdminCurriculumController::class,'create'])->name('curricula.create');
        Route::post('/curricula', [App\Http\Controllers\AdminCurriculumController::class, 'store'])->name("curricula.store");
        Route::get('/curricula/{curriculum}/edit', [App\Http\Controllers\AdminCurriculumController::class, 'edit'])->name("curricula.edit");
        Route::patch('/curricula/{curriculum}',[App\Http\Controllers\AdminCurriculumController::class,'update'])->name('curricula.update');
        Route::delete('/curricula/{curriculum}', [App\Http\Controllers\AdminCurriculumController::class, 'destroy'])->name("curricula.destroy");
        Route::get('/curricula/search', [App\Http\Controllers\AdminCurriculumController::class, 'search'])->name('curricula.search');
        Route::patch('/curricula/{curriculum}/status_on',[App\Http\Controllers\AdminCurriculumController::class,'status_on'])->name('curricula.status_on');
        Route::patch('/curricula/{curriculum}/status_off',[App\Http\Controllers\AdminCurriculumController::class,'status_off'])->name('curricula.status_off');
        Route::get('/curricula/selected/{curriculumCategory}',[App\Http\Controllers\AdminCurriculumController::class,'selected'])->name('curricula.selected');
        Route::patch('/curricula/{curriculum}/update_order', [App\Http\Controllers\AdminCurriculumController::class, 'update_order'])->name('curricula.update_order');


        Route::get('/curriculum_objectives',[App\Http\Controllers\AdminCurriculumObjectiveController::class,'index'])->name('curriculum_objectives.index');
        Route::get('/curriculum_objectives/create',[App\Http\Controllers\AdminCurriculumObjectiveController::class,'create'])->name('curriculum_objectives.create');
        Route::post('/curriculum_objectives', [App\Http\Controllers\AdminCurriculumObjectiveController::class, 'store'])->name("curriculum_objectives.store");
        Route::get('/curriculum_objectives/{curriculum_objective}/edit', [App\Http\Controllers\AdminCurriculumObjectiveController::class, 'edit'])->name("curriculum_objectives.edit");
        Route::patch('/curriculum_objectives/{curriculum_objective}',[App\Http\Controllers\AdminCurriculumObjectiveController::class,'update'])->name('curriculum_objectives.update');
        Route::delete('/curriculum_objectives/{curriculum_objective}', [App\Http\Controllers\AdminCurriculumObjectiveController::class, 'destroy'])->name("curriculum_objectives.destroy");
        Route::get('/curriculum_objectives/search', [App\Http\Controllers\AdminCurriculumObjectiveController::class, 'search'])->name('curriculum_objectives.search');

        Route::get('/curriculum_categories',[App\Http\Controllers\AdminCurriculumCategoryController::class,'index'])->name('curriculum_categories.index');
        Route::get('/curriculum_categories/order_by',[App\Http\Controllers\AdminCurriculumCategoryController::class,'order_by'])->name('curriculum_categories.order_by');
        Route::get('/curriculum_categories/create',[App\Http\Controllers\AdminCurriculumCategoryController::class,'create'])->name('curriculum_categories.create');
        Route::get('/curriculum_categories/{curriculum_category}/create_hierarchy',[App\Http\Controllers\AdminCurriculumCategoryController::class,'create_hierarchy'])->name('curriculum_categories.create_hierarchy');
        Route::post('/curriculum_categories', [App\Http\Controllers\AdminCurriculumCategoryController::class, 'store'])->name("curriculum_categories.store");
        Route::get('/curriculum_categories/{curriculum_category}/edit', [App\Http\Controllers\AdminCurriculumCategoryController::class, 'edit'])->name("curriculum_categories.edit");
        Route::patch('/curriculum_categories/{curriculum_category}',[App\Http\Controllers\AdminCurriculumCategoryController::class,'update'])->name('curriculum_categories.update');
        Route::delete('/curriculum_categories/{curriculum_category}', [App\Http\Controllers\AdminCurriculumCategoryController::class, 'destroy'])->name("curriculum_categories.destroy");
        Route::get('/curriculum_categories/search', [App\Http\Controllers\AdminCurriculumCategoryController::class, 'search'])->name('curriculum_categories.search');
        Route::patch('/curriculum_categories/{curriculum_category}/update_order', [App\Http\Controllers\AdminCurriculumCategoryController::class, 'update_order'])->name('curriculum_categories.update_order');


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
        Route::patch('/common_senses/{common_sense}/status_on',[App\Http\Controllers\AdminCommonSenseController::class,'status_on'])->name('common_senses.status_on');
        Route::patch('/common_senses/{common_sense}/status_off',[App\Http\Controllers\AdminCommonSenseController::class,'status_off'])->name('common_senses.status_off');
        Route::get('/common_senses/selected/{commonSenseCategory}',[App\Http\Controllers\AdminCommonSenseController::class,'selected'])->name('common_senses.selected');


        Route::get('/common_sense_categories',[App\Http\Controllers\AdminCommonSenseCategoryController::class,'index'])->name('common_sense_categories.index');
        Route::get('/common_sense_categories/create',[App\Http\Controllers\AdminCommonSenseCategoryController::class,'create'])->name('common_sense_categories.create');
        Route::post('/common_sense_categories', [App\Http\Controllers\AdminCommonSenseCategoryController::class, 'store'])->name("common_sense_categories.store");
        Route::get('/common_sense_categories/{common_sense_category}/edit', [App\Http\Controllers\AdminCommonSenseCategoryController::class, 'edit'])->name("common_sense_categories.edit");
        Route::patch('/common_sense_categories/{common_sense_category}',[App\Http\Controllers\AdminCommonSenseCategoryController::class,'update'])->name('common_sense_categories.update');
        Route::delete('/common_sense_categories/{common_sense_category}', [App\Http\Controllers\AdminCommonSenseCategoryController::class, 'destroy'])->name("common_sense_categories.destroy");
        Route::get('/common_sense_categories/search', [App\Http\Controllers\AdminCommonSenseCategoryController::class, 'search'])->name('common_sense_categories.search');
        Route::patch('/common_sense_categories/{common_sense_category}/status_on',[App\Http\Controllers\AdminCommonSenseCategoryController::class,'status_on'])->name('common_sense_categories.status_on');
        Route::patch('/common_sense_categories/{common_sense_category}/status_off',[App\Http\Controllers\AdminCommonSenseCategoryController::class,'status_off'])->name('common_sense_categories.status_off');

        Route::get('image_prints', [App\Http\Controllers\AdminImagePrintController::class, 'index'])->name("image_prints.index");
        Route::get('image_prints/create', [App\Http\Controllers\AdminImagePrintController::class, 'create'])->name("image_prints.create");
        Route::post('image_prints', [App\Http\Controllers\AdminImagePrintController::class, 'store'])->name("image_prints.store");
        Route::get('image_prints/{image_print}/preview', [App\Http\Controllers\AdminImagePrintController::class, 'preview'])->name("image_prints.preview");
        Route::get('image_prints/{image_print}/edit', [App\Http\Controllers\AdminImagePrintController::class, 'edit'])->name("image_prints.edit");
        Route::patch('image_prints/{image_print}', [App\Http\Controllers\AdminImagePrintController::class, 'update'])->name("image_prints.update");
        Route::delete('image_prints/{image_print}', [App\Http\Controllers\AdminImagePrintController::class, 'destroy'])->name("image_prints.destroy");


    });
});

