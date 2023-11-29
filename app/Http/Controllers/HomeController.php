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
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $webHierarchies = Web_hierarchy::all();
        $data = [
            'webHierarchies' => $webHierarchies
        ];
        return view('index',$data);
    }
}
