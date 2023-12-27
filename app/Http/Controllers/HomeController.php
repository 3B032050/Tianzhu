<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Slide;
use Illuminate\Http\Request;
use App\Models\Web_hierarchy;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    # 只有已登入的用戶才能訪問
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slides = Slide::all();
        $posts = Post::orderBy('created_at','DESC')->get();
        $data = ['slides'=>$slides,
            'posts' => $posts
        ];
        return view('index',$data);

    }
}
