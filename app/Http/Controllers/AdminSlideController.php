<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slide;
use Illuminate\Support\Facades\Storage;


class AdminSlideController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('order')->get();
        return view('admins.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admins.slides.create');
    }

    public function store(Request $request)
    {
        $slide = new Slide;

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            // 存储原始图片
            Storage::disk('slides')->put($imageName, file_get_contents($image));

            $slide->image_path = $imageName;
        }

        $slide->title = $request->input('title');
        $slide->order = Slide::max('order') + 1; // 取得目前最大 order 值並加 1
        $slide->status = 0;
        $slide->save();

        return redirect()->route('admins.slides.index')->with('success', 'Slide created successfully');
    }

    public function edit(Slide $slide)
    {
        $data = [
            'slide'=> $slide,
        ];
        return view('admins.slides.edit',$data);
    }

    public function update(Request $request, Slide $slide)
    {
        if ($request->hasFile('image_path')) {
            // Delete the old image from storage
            if ($slide->image_path) {
                Storage::disk('slides')->delete($slide->image_path);
            }

            // Upload the new image
            $image = $request->file('image_path');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            // Log the image file name
            Storage::disk('slides')->put($imageName, file_get_contents($image));

            // Set the new image path in the Slide instance
            $slide->image_path = $imageName;
        }

        $slide->title = $request->title;
        $slide->status = $request->status;

        $slide->save();

        return redirect()->route('admins.slides.index');
    }



    public function destroy(Slide $slide)
    {
//        dd($slide);
        $slide->delete();
        return redirect()->route('admins.slides.index');
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
                Slide::where('id', $itemId)->update(['order' => $index + 1]);
            }

            return redirect()->route('admins.slides.index');
        }

        return redirect()->route('admins.slides.index');
    }



}
