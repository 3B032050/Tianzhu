<?php

namespace App\Http\Controllers;

use App\Models\Web_hierarchy;
use App\Models\Web_content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminWebContentController extends Controller
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

    public function update(Request $request,$web_id)
    {
        $this->validate($request,[
            'content' => 'required',
        ]);
        $web_content = Web_content::where('web_id', $web_id)->first();

        // Update the content
        $web_content->content = $request->input('content');

        // Save changes
        $web_content->save();

        return redirect()->route('admins.web_hierarchies.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            // Save the image in the storage/web_images folder
            Storage::disk('web_images')->put($fileName, file_get_contents($request->file('upload')));

            $url = Storage::disk('web_images')->url($fileName);

            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
