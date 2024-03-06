<?php

namespace App\Http\Controllers;

use App\Models\CourseObjective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCourseObjectiveController extends Controller
{
    public function index()
    {
        $courseObjectives = CourseObjective::orderBy('id', 'ASC')->get();
        $data = ['courseObjectives' => $courseObjectives];
        return view('admins.course_objectives.index', $data);
    }

    public function create()
    {
        return view('admins.course_objectives.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'description' => 'required|max:255',
        ]);

        $adminId = Auth::user()->admin->id;
        CourseObjective::create(array_merge($request->all(), ['last_modified_by' => $adminId]));
        return redirect()->route('admins.course_objectives.index');
    }

    public function edit(CourseObjective $courseObjective)
    {
        $data = [
            'courseObjective'=> $courseObjective,
        ];
        return view('admins.course_objectives.edit',$data);
    }

    public function update(Request $request, CourseObjective $courseObjective)
    {
        $this->validate($request,[
            'description' => 'required|max:255',
        ]);

        $adminId = Auth::user()->admin->id;
        $courseObjective->update(array_merge($request->all(), ['last_modified_by' => $adminId]));
        return redirect()->route('admins.course_objectives.index');
    }

    public function destroy(CourseObjective $courseObjective)
    {
        $courseObjective->delete();
        return redirect()->route('admins.course_objectives.index');
    }
}
