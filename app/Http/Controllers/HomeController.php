<?php

namespace App\Http\Controllers;

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
        return view('index');
    }
}
