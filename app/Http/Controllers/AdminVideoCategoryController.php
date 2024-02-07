<?php

namespace App\Http\Controllers;

use App\Models\Video_category;
use Illuminate\Http\Request;

class AdminVideoCategoryController extends Controller
{
    public function index()
    {
        $videoCategories = Video_category::orderBy('id', 'ASC')->get();
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

        Video_category::create($request->all());
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

        $video_category->update($request->all());
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
}
