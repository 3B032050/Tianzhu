<?php

namespace App\Http\Controllers;

use App\Models\CourseMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCourseMethodController extends Controller
{
    public function index()
    {
        $courseMethods = CourseMethod::orderBy('id', 'ASC')->where('status', 1)->get();

        foreach ($courseMethods as $method) {
            $method->recentActions = $this->getRecentActions($method->id);
        }

        $data = ['courseMethods' => $courseMethods];
        return view('admins.course_methods.index', $data);
    }

    public function history()
    {
        $courseMethods = CourseMethod::orderBy('updated_at', 'DESC')->where('status', -1)->get();

        foreach ($courseMethods as $method) {
            $method->recentActions = $this->getRecentActions($method->id);
        }

        $data = ['courseMethods' => $courseMethods];
        return view('admins.course_methods.history', $data);
    }

    private function getRecentActions($methodId)
    {
        $courseMethod = CourseMethod::findOrFail($methodId);

        $recentActions = [
            $courseMethod->last_1_modified_by,
            $courseMethod->last_2_modified_by,
            $courseMethod->last_3_modified_by,
            $courseMethod->last_4_modified_by,
            $courseMethod->last_5_modified_by,
        ];

        $formattedActions = [];
        foreach ($recentActions as $action) {
            if ($action) {
                $actionParts = explode(",", $action);
                $time = $actionParts[0] ?? '';
                $user = $actionParts[1] ?? '';
                $actionContent = $actionParts[2] ?? '';
                $formattedActions[] = [
                    'time' => $time,
                    'user' => $user,
                    'action' => $actionContent
                ];
            }
        }

        return $formattedActions;
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

        CourseMethod::create(array_merge($request->all(), [
            'last_1_modified_by' => now().",".Auth::user()->name.",新增",
        ]));
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

        $courseMethod->last_5_modified_by = $courseMethod->last_4_modified_by;
        $courseMethod->last_4_modified_by = $courseMethod->last_3_modified_by;
        $courseMethod->last_3_modified_by = $courseMethod->last_2_modified_by;
        $courseMethod->last_2_modified_by = $courseMethod->last_1_modified_by;
        $courseMethod->last_1_modified_by = now().",".Auth::user()->name.",修改";

        $courseMethod->update($request->all());
        return redirect()->route('admins.course_methods.index');
    }

    public function destroy(CourseMethod $courseMethod)
    {
        $courseMethod->status = -1;

        $courseMethod->last_5_modified_by = $courseMethod->last_4_modified_by;
        $courseMethod->last_4_modified_by = $courseMethod->last_3_modified_by;
        $courseMethod->last_3_modified_by = $courseMethod->last_2_modified_by;
        $courseMethod->last_2_modified_by = $courseMethod->last_1_modified_by;
        $courseMethod->last_1_modified_by = now().",".Auth::user()->name.",刪除";

        $courseMethod->save();
        return redirect()->route('admins.course_methods.index');
    }

    public function restore(CourseMethod $courseMethod)
    {
        $courseMethod->status = 1;

        $courseMethod->last_5_modified_by = $courseMethod->last_4_modified_by;
        $courseMethod->last_4_modified_by = $courseMethod->last_3_modified_by;
        $courseMethod->last_3_modified_by = $courseMethod->last_2_modified_by;
        $courseMethod->last_2_modified_by = $courseMethod->last_1_modified_by;
        $courseMethod->last_1_modified_by = now().",".Auth::user()->name.",刪除復原";

        $courseMethod->save();
        return redirect()->route('admins.course_methods.index');
    }
}
