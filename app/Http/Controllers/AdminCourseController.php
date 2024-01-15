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
            'method' => 'nullable|max:255',
            'course_category' => 'required|exists:course_categories,id',
            'course_methods' => 'array',
            'course_objectives' => 'array',
            'time' => 'nullable|max:255',
            'note' => 'nullable|max:255',
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
        $course_categories = CourseCategory::all();
        $course_methods = CourseMethod::all();
        $course_objectives = CourseObjective::all();

        $selectedMethods = $course->methods->pluck('id')->toArray();
        $selectedObjectives = $course->objectives->pluck('id')->toArray();

        $data = [
            'course' => $course,
            'course_categories' => $course_categories,
            'course_methods' => $course_methods,
            'course_objectives' => $course_objectives,
            'selectedMethods' => $selectedMethods,
            'selectedObjectives' => $selectedObjectives,
        ];

        return view('admins.courses.edit',$data);
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|max:50',
            'method' => 'nullable|max:255',
            'course_category' => 'required|exists:course_categories,id',
            'course_methods' => 'array',
            'course_objectives' => 'array',
            'time' => 'nullable|max:255',
            'note' => 'nullable|max:255',
        ]);

        // Update the Course model
        $course->update([
            'title' => $request->input('title'),
            'method' => $request->input('method'),
            'course_category_id' => $request->input('course_category'),
            'time' => $request->input('time'),
            'note' => $request->input('note'),
        ]);

        // Sync the related methods
        $course->methods()->sync($request->input('course_methods', []));

        // Sync the related objectives
        $course->objectives()->sync($request->input('course_objectives', []));

        return redirect()->route('admins.courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admins.courses.index');
    }
}
