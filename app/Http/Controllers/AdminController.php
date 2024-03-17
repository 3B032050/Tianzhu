<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admins.dashboard.index');
    }

    public function home()
    {
        return view('admins.dashboard.index');
    }
//    public  function Automaticloading ()
//    {
//        $currentday = Carbon::now();
//        $posts = Post::orderBy('created_at','DESC')->get();
//        foreach($posts as $index => $post)
//        {
//            if ($post->announce_date >= $currentday && $post->status != '1')
//            {
//                $post->status='1';
//                $post->save();
//            }
//
//        }
//        return view('admins.dashboard.index');
//    }
}
