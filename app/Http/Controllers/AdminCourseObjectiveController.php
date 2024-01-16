<?php

namespace App\Http\Controllers;

use App\Models\CourseObjective;
use Illuminate\Http\Request;

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

        CourseObjective::create($request->all());
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

        $courseObjective->update($request->all());
        return redirect()->route('admins.course_objectives.index');
    }

    public function destroy(CourseObjective $courseObjective)
    {
        $courseObjective->delete();
        return redirect()->route('admins.course_objectives.index');
    }
}
