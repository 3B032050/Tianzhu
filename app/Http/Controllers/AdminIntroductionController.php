<?php

namespace App\Http\Controllers;

use App\Models\Introduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminIntroductionController extends Controller
{
    public function index()
    {
        $introductions = Introduction::orderby('id','ASC')->get();
        $data = ['introductions' => $introductions];
        return view('admins.introductions.index',$data);
    }

    public function traffic()
    {
        $introduction = Introduction::where('title', '交通資訊')->first();

        if (!$introduction) {
            $introduction = Introduction::create([
                'title' => '交通資訊',
                'content' => '',
            ]);
        }

        $data = [
            'introduction' => $introduction,
        ];

        return view('admins.introductions.edit', $data);
    }

    public function origin()
    {
        $introduction = Introduction::where('title', '緣起與宗旨')->first();

        if (!$introduction) {
            $introduction = Introduction::create([
                'title' => '緣起與宗旨',
                'content' => '',
            ]);
        }

        $data = [
            'introduction' => $introduction,
        ];

        return view('admins.introductions.edit', $data);
    }

    public function update(Request $request, Introduction $introduction)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $introduction->update($request->all());
        return redirect()->route('admins.introductions.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            // Save the image in the storage/web_images folder
            Storage::disk('introductions')->put($fileName, file_get_contents($request->file('upload')));

            $url = Storage::disk('introductions')->url($fileName);

            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
