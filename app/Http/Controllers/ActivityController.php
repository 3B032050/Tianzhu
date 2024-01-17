<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::orderBy('id','ASC')->get();
        $data = ['activities' => $activities];

        return view('activities.index',$data);
    }

    public function show(Activity $activity)
    {
        $data = ['activity' => $activity];

        return view('activities.show',$data);
    }
}
