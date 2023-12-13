<?php

namespace App\Http\Controllers;

use App\Models\Web_content;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        $web_content = Web_content::where('web_id','1')->first();
        $data = ['web_content' => $web_content];
        return view('web.index',$data);
    }
}
