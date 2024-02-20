<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;

class AdminActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::orderby('id','ASC')->get();
        $data = ['activities' => $activities];
        return view('admins.activities.index',$data);
    }

    public function create()
    {
        return view('admins.activities.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:50',
            'content' => 'required',
        ]);

        Activity::create($request->all());
        return redirect()->route('admins.activities.index');
    }

    public function edit(Activity $activity)
    {
        $data = [
            'activity'=> $activity,
        ];
        return view('admins.activities.edit',$data);
    }

    public function update(Request $request, Activity $activity)
    {
        $this->validate($request,[
            'title' => 'required|max:50',
            'content' => 'required',
        ]);

        $activity->update($request->all());
        return redirect()->route('admins.activities.index');
    }

    public function statusOn(Request $request, Activity $activity)
    {
        $activity->update(['status' => 1]);
        return redirect()->route('admins.activities.index');
    }

    public function statusOff(Request $request, Activity $activity)
    {
        $activity->update(['status' => 0]);
        return redirect()->route('admins.activities.index');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('admins.activities.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            // Save the image in the storage/web_images folder
            Storage::disk('activities')->put($fileName, file_get_contents($request->file('upload')));

            $url = Storage::disk('activities')->url($fileName);

            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
