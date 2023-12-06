<?php

namespace App\Http\Controllers;

use App\Models\Web_hierarchy;
use App\Models\Web_content;
use Illuminate\Http\Request;

class AdminWebContentsController extends Controller
{
    public function index()
    {
        $web_hierarchies = Web_hierarchy::orderby('web_id','ASC')->get();
        $data = ['web_hierarchies' => $web_hierarchies];
        return view('admins.web_contents.index',$data);
    }

    public function edit($web_content)
    {
        $web_hierarchy = Web_hierarchy::where('web_id',$web_content)->first();
        $web_content = Web_content::where('web_id',$web_content)->first();
        $data = [
            'web_hierarchy'=> $web_hierarchy,
            'web_content' => $web_content,
        ];
        return view('admins.web_contents.edit',$data);
    }

    public function update(Request $request,Web_content $web_content)
    {
//        $this->validate($request,[
//            'title' => 'required|max:50',
//            'content' => 'required',
//            'is_feature' => 'required|boolean',
//        ]);

        $web_content->update($request->all());
        return redirect()->route('admins.contents.index');
    }
}
