<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use App\Models\CourseMethod;
use App\Models\CourseObjective;
use Illuminate\Http\Request;
use App\Models\Course;

class AdminCourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::orderby('id','ASC')->get();
        $data = ['courses' => $courses];
        return view('admins.courses.index',$data);
    }

    public function create()
    {
        $course_categories = CourseCategory::get();
        $course_objectives = CourseObjective::get();
        $course_methods = CourseMethod::get();

        // 將數據添加到 $data 陣列中
        $data = [
            'course_categories' => $course_categories,
            'course_objectives' => $course_objectives,
            'course_methods' => $course_methods,
        ];

        return view('admins.courses.create',$data);
    }

    public function store(Request $request)
    {
        // 驗證表單輸入
        $request->validate([
            'title' => 'required|string',
            'course_category' => 'required|exists:course_categories,id',
            'course_methods' => 'required',
            'course_objectives' => 'required',
        ]);

        // 創建課程
        $course = new Course();
        $course->title = $request->input('title');
        $course->course_category_id = $request->input('course_category');
        $course->method = $request->input('method');
        $course->time = $request->input('time');
        $course->note = $request->input('note');

        // 儲存課程
        $course->save();

        // 將方法關聯到中介表格
        $course->methods()->sync($request->input('course_methods'));

        // 將目標關聯到中介表格
        $course->objectives()->sync($request->input('course_objectives'));

        return redirect()->route('admins.courses.index');
    }

    public function edit(Course $course)
    {
        $data = [
            'course'=> $course,
        ];
        return view('admins.courses.edit',$data);
    }

    public function update(Request $request, Course $course)
    {
//        $this->validate($request,[
//            'title' => 'required|max:50',
//            'content' => 'required',
//            'is_feature' => 'required|boolean',
//        ]);

        $course->update($request->all());
        return redirect()->route('admins.courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admins.courses.index');
    }
}
