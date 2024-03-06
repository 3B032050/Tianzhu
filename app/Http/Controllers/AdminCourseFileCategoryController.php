<?php

namespace App\Http\Controllers;

use App\Models\CourseFileCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCourseFileCategoryController extends Controller
{
    public function index()
    {
        $course_file_categories = CourseFileCategory::orderBy('id', 'ASC')->get();
        $data = ['course_file_categories' => $course_file_categories];
        return view('admins.course_file_categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.course_file_categories.create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'course_file_category_name' => 'required|max:255',
        ]);

        $adminId = Auth::user()->admin->id;
        CourseFileCategory::create(array_merge($request->all(), ['last_modified_by' => $adminId]));
        return redirect()->route('admins.course_file_categories.index');
    }
    public function edit(CourseFileCategory $course_file_category)
    {
        $data = [
            'course_file_category'=> $course_file_category,
        ];
        return view('admins.course_file_categories.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseFileCategory $course_file_category)
    {
        $this->validate($request,[
            'course_file_category_name' => 'required|max:255',
        ]);

        $adminId = Auth::user()->admin->id;
        $course_file_category->update(array_merge($request->all(), ['last_modified_by' => $adminId]));
        return redirect()->route('admins.course_file_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseFileCategory $course_file_category)
    {
        $course_file_category->delete();
        return redirect()->route('admins.course_file_categories.index');
    }
}
