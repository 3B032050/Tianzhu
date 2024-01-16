<?php

namespace App\Http\Controllers;

use App\Models\CourseOverview;
use Illuminate\Http\Request;

class AdminCourseOverviewController extends Controller
{
    public function edit()
    {
        // 檢查是否存在 title 為 "總覽" 的記錄
        $courseOverview = CourseOverview::where('title', '總覽')->first();

        // 如果存在，則取出該記錄；否則創建新記錄
        if (!$courseOverview) {
            $courseOverview = CourseOverview::create([
                'title' => '總覽',
                'content' => '',
            ]);
        }

        $data = [
            'courseOverview' => $courseOverview,
        ];

        return view('admins.course_overviews.edit', $data);
    }

    public function update(Request $request, CourseOverview $courseOverview)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
        ]);

        $courseOverview->update($request->all());
        return redirect()->route('admins.courses.index');
    }
}
