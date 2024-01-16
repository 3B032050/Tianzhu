<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use App\Models\CourseOverview;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function overview()
    {
        $courseOverview = CourseOverview::where('title','總覽')->first();
        $data = ['courseOverview' => $courseOverview];

        return view('courses.overview',$data);
    }

    public function show(CourseCategory $courseCategory)
    {
        $selectedCategory = CourseCategory::where('id',$courseCategory->id)->first();
        $data = ['selectedCategory' => $selectedCategory];

        return view('courses.show',$data);
    }
}
