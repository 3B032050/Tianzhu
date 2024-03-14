<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
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
            'file' => 'file|mimes:jpeg,png,pdf,doc,docx,pptx,ppt',
        ]);
        if ($request->hasFile('file')) {
            $fileName = $request->file('file')->getClientOriginalName(); // 獲取上傳檔名
            $request->file('file')->storeAs('public', $fileName); //
        } else {
            $fileName = null;
        }
        $content = strip_tags($request->input('content'));
        $adminId = Auth::user()->admin->id;
        Post::create([
            'title' => $request->input('title'),
            'content' => $content,
            'is_feature' => $request->input('is_feature'),
            'file' => $fileName, // 存储文件名
            'status'=>$request->input('status'),
            'last_modified_by' => $adminId,
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
        $adminId = Auth::user()->admin->id;
        $post->update([
            'title' => $request->input('title'),
            'content' => $content,
            'is_feature' => $request->input('is_feature'),
            'status'=>$request->input('status'),
            'last_modified_by' => $adminId,
        ]);
        return redirect()->route('admins.posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admins.posts.index');
    }
    public function statusoff(Post $post)
    {
        $post->status='0';

        $adminId = Auth::user()->admin->id;
        $post->last_modified_by = $adminId;

        $post->save();
        return back();
    }
    public function statuson(Post $post)
    {
        $post->status = '1';

        $adminId = Auth::user()->admin->id;
        $post->last_modified_by = $adminId;

        $post->save();
        return back();
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $perPage = $request->input('perPage', 10);

        $searchTerm->where('title', 'like', "%$searchTerm%");


        $posts = $searchTerm->orderBy('id', 'ASC')->paginate($perPage);

        return view('admins.course_file.index', [
            'posts' => $posts,
            'query' => $searchTerm,
        ]);
    }
}

