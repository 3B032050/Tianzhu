<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

    public function by_category(CourseCategory $courseCategory)
    {
        $selectedCategory = CourseCategory::findOrFail($courseCategory->id);

        $data = ['selectedCategory' => $selectedCategory];

        return view('courses.by_category',$data);
    }

    public function search(CourseCategory $courseCategory,Request $request)
    {
        $selectedCategory = CourseCategory::findOrFail($courseCategory->id);
        if ($request->input('query')) {
            $query = $request->input('query');
            $selectedCategory->courses = $selectedCategory->courses
                ->filter(function ($course) use ($query) {
                    return strpos($course->title, $query) !== false;
                });
        }

        $data = ['selectedCategory' => $selectedCategory];

        return view('courses.by_category_search',$data);
    }

    public function show(CourseCategory $courseCategory,Course $course)
    {
        $selectedCategory = CourseCategory::where('id',$courseCategory->id)->first();
        $data = ['selectedCategory' => $selectedCategory, 'course' => $course];

        return view('courses.show',$data);
    }
}
