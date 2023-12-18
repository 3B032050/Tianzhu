<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function show(Post $post)
    {
        $post = Post::orderBy('created_at','DESC')->first();
        $data = ['post' => $post];


        return view('show',$data);
    }
    public function post_download(Request $request)
    {
        $post = Post::orderBy('created_at','DESC')->first();
        $file = $post->file;


        $filePath = "public/$file";
        $fileName = $file;
        $fileSize = Storage::size($filePath);
        $mimeType = Storage::mimeType($filePath);
        $headers = ['Content-Type' => $mimeType];
        return Storage::download($filePath, $fileName, $headers);



    }


}
