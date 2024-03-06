<?php

namespace App\Http\Controllers;

use App\Models\CourseMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCourseMethodController extends Controller
{
    public function index()
    {
        $courseMethods = CourseMethod::orderBy('id', 'ASC')->get();
        $data = ['courseMethods' => $courseMethods];
        return view('admins.course_methods.index', $data);
    }

    public function create()
    {
        return view('admins.course_methods.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        $adminId = Auth::user()->admin->id;
        CourseMethod::create(array_merge($request->all(), ['last_modified_by' => $adminId]));
        return redirect()->route('admins.course_methods.index');
    }

    public function edit(CourseMethod $courseMethod)
    {
        $data = [
            'courseMethod'=> $courseMethod,
        ];
        return view('admins.course_methods.edit',$data);
    }

    public function update(Request $request, CourseMethod $courseMethod)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        $adminId = Auth::user()->admin->id;
        $courseMethod->update(array_merge($request->all(), ['last_modified_by' => $adminId]));
        return redirect()->route('admins.course_methods.index');
    }

    public function destroy(CourseMethod $courseMethod)
    {
        $courseMethod->delete();
        return redirect()->route('admins.course_methods.index');
    }
}
