<?php

namespace App\Http\Controllers;

use App\Models\Web_hierarchy;
use App\Models\Web_content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function update(Request $request,$web_id)
    {
        $this->validate($request,[
            'content' => 'required',
//            'image_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $web_content = Web_content::where('web_id', $web_id)->first();

//        if (!$web_content) {
//            // Handle the case where the web_content is not found.
//            // You might want to redirect back with an error message.
//            return redirect()->back()->with('error', 'Web Content not found.');
//        }

        if ($request->hasFile('image_url')) {
            // Delete the old image from storage
            if ($web_content->image_url) {
                Storage::disk('web_images')->delete($web_content->image_url);
            }

            // Upload the new image
            $image = $request->file('image_url');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            // Log the image file name
            Storage::disk('web_images')->put($imageName, file_get_contents($image));

            // Set the new image URL in the Product instance
            $web_content->image_url = $imageName;
        }

        // Update the content
        $web_content->content = $request->input('content');

        // Save changes
        $web_content->save();

        return redirect()->route('admins.web_hierarchies.index');
    }
}
