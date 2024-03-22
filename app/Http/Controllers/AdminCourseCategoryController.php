<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use App\Models\CourseObjective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCourseCategoryController extends Controller
{
    public function index()
    {
        $courseCategories = CourseCategory::orderBy('id', 'ASC')->where('status', 1)->get();

        // 获取每个课程类别的最近动作
        foreach ($courseCategories as $category) {
            $category->recentActions = $this->getRecentActions($category->id);
        }

        $data = ['courseCategories' => $courseCategories];
        return view('admins.course_categories.index', $data);
    }

    public function history()
    {
        $courseCategories = CourseCategory::orderBy('updated_at', 'DESC')->where('status', -1)->get();

        // 获取每个课程类别的最近动作
        foreach ($courseCategories as $category) {
            $category->recentActions = $this->getRecentActions($category->id);
        }

        $data = ['courseCategories' => $courseCategories];
        return view('admins.course_categories.history', $data);
    }

    private function getRecentActions($categoryId)
    {
        $courseCategory = CourseCategory::findOrFail($categoryId);

        $recentActions = [
            $courseCategory->last_1_modified_by,
            $courseCategory->last_2_modified_by,
            $courseCategory->last_3_modified_by,
            $courseCategory->last_4_modified_by,
            $courseCategory->last_5_modified_by,
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

    public function order_by()
    {
        $courseCategories = CourseCategory::orderBy('order_by')->get();
        $data = ['courseCategories' => $courseCategories];
        return view('admins.course_categories.order_by', $data);
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

        CourseCategory::create(array_merge($request->all(), [
            'order_by' => CourseCategory::max('order_by') + 1,
            'last_1_modified_by' => now().",".Auth::user()->name.",新增",
        ]));

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

        $courseCategory->last_5_modified_by = $courseCategory->last_4_modified_by;
        $courseCategory->last_4_modified_by = $courseCategory->last_3_modified_by;
        $courseCategory->last_3_modified_by = $courseCategory->last_2_modified_by;
        $courseCategory->last_2_modified_by = $courseCategory->last_1_modified_by;
        $courseCategory->last_1_modified_by = now().",".Auth::user()->name.",修改";

        $courseCategory->update($request->all());

        return redirect()->route('admins.course_categories.index');
    }

    public function destroy(CourseCategory $courseCategory)
    {
        $courseCategory->status = -1;

        $courseCategory->last_5_modified_by = $courseCategory->last_4_modified_by;
        $courseCategory->last_4_modified_by = $courseCategory->last_3_modified_by;
        $courseCategory->last_3_modified_by = $courseCategory->last_2_modified_by;
        $courseCategory->last_2_modified_by = $courseCategory->last_1_modified_by;
        $courseCategory->last_1_modified_by = now().",".Auth::user()->name.",刪除";

        $courseCategory->save();

        return redirect()->route('admins.course_categories.index');
    }

    public function restore(CourseCategory $courseCategory)
    {
        $courseCategory->status = 1;

        $courseCategory->last_5_modified_by = $courseCategory->last_4_modified_by;
        $courseCategory->last_4_modified_by = $courseCategory->last_3_modified_by;
        $courseCategory->last_3_modified_by = $courseCategory->last_2_modified_by;
        $courseCategory->last_2_modified_by = $courseCategory->last_1_modified_by;
        $courseCategory->last_1_modified_by = now().",".Auth::user()->name.",刪除復原";

        $courseCategory->save();

        return redirect()->route('admins.course_categories.index');
    }

    public function update_order(Request $request)
    {
        // 使用 $request->input('sortedIds') 獲取排序的順序
        $sortedIds = $request->input('sortedIds');

        // 確保 $sortedIds 是字符串
        if (is_string($sortedIds)) {
            // 使用 explode 函數將字符串拆分成數組
            $sortedIdsArray = explode(',', $sortedIds);

            // 更新數據庫中的排序
            foreach ($sortedIdsArray as $index => $itemId) {
                CourseCategory::where('id', $itemId)->update(['order_by' => $index + 1]);
            }

            return redirect()->route('admins.course_categories.order_by');
        }

        return redirect()->route('admins.course_categories.order_by');
    }
}
