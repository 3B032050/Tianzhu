<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slide;
use Illuminate\Support\Facades\Storage;


class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        return view('admins.slides.index',compact('slides'));
    }

    public function create()
    {
        return view('admins.slides.create');
    }

    public function store(Request $request)
    {

//        $this->validate($request, [
//            'title' => 'required',
//            'description' => 'required',
//            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:8192',
//        ]);

        $slide = new Slide;

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            // 存储原始图片
            Storage::disk('slides')->put($imageName, file_get_contents($image));

            $slide->image_path = $imageName;
        }

        $slide->title = $request->input('title');
        $slide->description = $request->input('description');
        $slide->status = 0;
        $slide->save();

        return redirect()->route('admins.slides.index')->with('success', 'Slide created successfully');
    }


}
