<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCourseCategoryController extends Controller
{
    public function index()
    {
        $courseCategories = CourseCategory::orderBy('id', 'ASC')->get();
        $data = ['courseCategories' => $courseCategories];
        return view('admins.course_categories.index', $data);
    }

    public function create()
    {
        return view('admins.course_categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        $adminId = Auth::user()->admin->id;
        CourseCategory::create(array_merge($request->all(), ['last_modified_by' => $adminId]));
        return redirect()->route('admins.course_categories.index');
    }

    public function edit(CourseCategory $courseCategory)
    {
        $data = [
            'courseCategory'=> $courseCategory,
        ];
        return view('admins.course_categories.edit',$data);
    }

    public function update(Request $request, CourseCategory $courseCategory)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        $adminId = Auth::user()->admin->id;
        $courseCategory->update(array_merge($request->all(), ['last_modified_by' => $adminId]));
        return redirect()->route('admins.course_categories.index');
    }

    public function destroy(CourseCategory $courseCategory)
    {
        $courseCategory->delete();
        return redirect()->route('admins.course_categories.index');
    }
}
