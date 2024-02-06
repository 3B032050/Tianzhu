<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Video_category;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('id', 'ASC')->get();
        $data = ['videos' => $videos];
        return view('admins.videos.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $video_categories = Video_category::get();
        $data = [
            'video_categories' =>$video_categories,
            ];
        return view('admins.videos.create',$data);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'video_category_id' => 'required',
            'video_url' => 'required',

        ]);

        Video::create($request->all());
        return redirect()->route('admins.videos.index');
    }
    public function edit(Video $video)
    {
        $data = [
            'video'=> $video,
        ];
        return view('admins.videos.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $this->validate($request,[
            'video_category_id' => 'required',
            'video_url'=> 'required',
        ]);

        $video->update($request->all());
        return redirect()->route('admins.videos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admins.videos.index');
    }
}
