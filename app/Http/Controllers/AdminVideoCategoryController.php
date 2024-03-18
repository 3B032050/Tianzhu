<?php

namespace App\Http\Controllers;

use App\Models\Video_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVideoCategoryController extends Controller
{
    public function index()
    {
        $videoCategories = Video_category::orderBy('order_category_id', 'ASC')->get();
        $data = ['videoCategories' => $videoCategories];
        return view('admins.video_categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.video_categories.create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_name' => 'required|max:255',
        ]);

        $adminId = Auth::user()->admin->id;
        $order_category_id =  Video_category::max('order_category_id') + 1;
        $videoCategory = Video_category::create(array_merge($request->all(), ['last_modified_by' => $adminId, 'order_category_id' => $order_category_id]));
        return redirect()->route('admins.video_categories.index');
    }
    public function edit(Video_category $video_category)
    {
        $data = [
            'video_category'=> $video_category,
        ];
        return view('admins.video_categories.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video_category $video_category)
    {
        $this->validate($request,[
            'category_name' => 'required|max:255',
        ]);

        $adminId = Auth::user()->admin->id;
        $video_category->update(array_merge($request->all(), ['last_modified_by' => $adminId]));
        return redirect()->route('admins.video_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video_category $video_category)
    {
        $video_category->delete();
        return redirect()->route('admins.video_categories.index');
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
                Video_category::where('id', $itemId)->update(['order_category_id' => $index + 1]);
            }

            return redirect()->route('admins.video_categories.index');
        }

        return redirect()->route('admins.video_categories.index');
    }
}
