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
        $courseCategories = CourseCategory::orderBy('id', 'ASC')->get();
        $data = ['courseCategories' => $courseCategories];
        return view('admins.course_categories.index', $data);
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

        $order_by = CourseCategory::max('order_by') + 1;
        $adminId = Auth::user()->admin->id;
        CourseCategory::create(array_merge($request->all(), ['last_modified_by' => $adminId, 'order_by' => $order_by]));
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
