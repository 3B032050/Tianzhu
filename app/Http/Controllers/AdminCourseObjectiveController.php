<?php

namespace App\Http\Controllers;

use App\Models\CourseObjective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCourseObjectiveController extends Controller
{
    public function index()
    {
        $courseObjectives = CourseObjective::orderBy('id', 'ASC')->where('status', 1)->get();

        foreach ($courseObjectives as $objective) {
            $objective->recentActions = $this->getRecentActions($objective->id);
        }

        $data = ['courseObjectives' => $courseObjectives];
        return view('admins.course_objectives.index', $data);
    }

    public function history()
    {
        $courseObjectives = CourseObjective::orderBy('updated_at', 'DESC')->where('status', -1)->get();

        foreach ($courseObjectives as $objective) {
            $objective->recentActions = $this->getRecentActions($objective->id);
        }

        $data = ['courseObjectives' => $courseObjectives];
        return view('admins.course_objectives.history', $data);
    }

    private function getRecentActions($objectiveId)
    {
        $courseObjective = CourseObjective::findOrFail($objectiveId);

        $recentActions = [
            $courseObjective->last_1_modified_by,
            $courseObjective->last_2_modified_by,
            $courseObjective->last_3_modified_by,
            $courseObjective->last_4_modified_by,
            $courseObjective->last_5_modified_by,
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
        return view('admins.course_objectives.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'description' => 'required|max:255',
        ]);

        CourseObjective::create(array_merge($request->all(), [
            'last_1_modified_by' => now().",".Auth::user()->name.",新增",
        ]));
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

        $courseObjective->last_5_modified_by = $courseObjective->last_4_modified_by;
        $courseObjective->last_4_modified_by = $courseObjective->last_3_modified_by;
        $courseObjective->last_3_modified_by = $courseObjective->last_2_modified_by;
        $courseObjective->last_2_modified_by = $courseObjective->last_1_modified_by;
        $courseObjective->last_1_modified_by = now().",".Auth::user()->name.",修改";

        $courseObjective->update($request->all());
        return redirect()->route('admins.course_objectives.index');
    }

    public function destroy(CourseObjective $courseObjective)
    {
        $courseObjective->status = -1;

        $courseObjective->last_5_modified_by = $courseObjective->last_4_modified_by;
        $courseObjective->last_4_modified_by = $courseObjective->last_3_modified_by;
        $courseObjective->last_3_modified_by = $courseObjective->last_2_modified_by;
        $courseObjective->last_2_modified_by = $courseObjective->last_1_modified_by;
        $courseObjective->last_1_modified_by = now().",".Auth::user()->name.",刪除";

        $courseObjective->save();
        return redirect()->route('admins.course_objectives.index');
    }

    public function restore(CourseObjective $courseObjective)
    {
        $courseObjective->status = 1;

        $courseObjective->last_5_modified_by = $courseObjective->last_4_modified_by;
        $courseObjective->last_4_modified_by = $courseObjective->last_3_modified_by;
        $courseObjective->last_3_modified_by = $courseObjective->last_2_modified_by;
        $courseObjective->last_2_modified_by = $courseObjective->last_1_modified_by;
        $courseObjective->last_1_modified_by = now().",".Auth::user()->name.",刪除復原";

        $courseObjective->save();
        return redirect()->route('admins.course_objectives.index');
    }
}
