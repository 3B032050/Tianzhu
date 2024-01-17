<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at','DESC')->get();
        $data = ['posts' => $posts];
        return view('admins.posts.index',$data);
    }


    public function create()
    {
        return view('admins.posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:50',
            'content' => 'required',
            'is_feature' => 'required|boolean',
            'file' => 'required|file|mimes:jpeg,png,pdf,doc,docx,pptx,ppt',
        ]);
        if ($request->hasFile('file')) {
            $fileName = $request->file('file')->getClientOriginalName(); // 獲取上傳檔名
            $request->file('file')->storeAs('public', $fileName); //
        } else {
            $fileName = null;
        }
        $content = strip_tags($request->input('content'));
         Post::create([
            'title' => $request->input('title'),
            'content' => $content,
            'is_feature' => $request->input('is_feature'),
            'file' => $fileName, // 存储文件名
        ]);
//        if ($request->hasFile('file'))
//        {
//            $filePath = $request->file('file')->store('public');
//        }
//        else
//        {
//            $filePath = null;
//        }
//        Post::create($request->all());
        return redirect()->route('admins.posts.index');
    }

    public function edit(Post $post)
    {
        $data = [
            'post'=> $post,
        ];
        return view('admins.posts.edit',$data);
    }

    public function update(Request $request, Post $post)
    {
//        $this->validate($request,[
//            'title' => 'required|max:50',
//            'content' => 'required',
//            'is_feature' => 'required|boolean',
//
//        ]);
//
//        $post->update($request->all());
        $this->validate($request,[
            'title' => 'required|max:50',
            'content' => 'required',
            'is_feature' => 'required|boolean',
            'file' => 'sometimes|nullable|file|mimes:jpeg,png,pdf,doc,docx,pptx,ppt',
        ]);
        if ($request->hasFile('file'))
        {
            if ($post->file)
            {
                Storage::delete('public/' . $post->file);
            }

            $newfileName = $request->file('file')->getClientOriginalName(); // 獲取上傳檔名
            $request->file('file')->storeAs('public', $newfileName);
            $post->update(['file' => $newfileName]);

        }
        else {
            $fileName = null;
        }
        $content = strip_tags($request->input('content'));
        $post->update([
            'title' => $request->input('title'),
            'content' => $content,
            'is_feature' => $request->input('is_feature'),

        ]);
        return redirect()->route('admins.posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admins.posts.index');
    }
}

