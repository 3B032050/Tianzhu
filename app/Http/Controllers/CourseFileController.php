<?php

namespace App\Http\Controllers;

use App\Models\CourseFile;
use App\Models\CourseFileCategory;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseFileController extends Controller
{
    public function index()
    {
        $course_file_categories = CourseFileCategory::orderBy('id', 'ASC')->get();
        return view('course_file.index', compact('course_file_categories'));
    }
    public function show(CourseFileCategory $category)
    {
        $selectcoursefilecategory = $category;
        $coursefiles = CourseFile::where('status','1')->where('course_file_category_id', $category->id)
            ->get();
        $data = ['coursefiles' => $coursefiles,'selectcoursefilecategory'=>$selectcoursefilecategory];


        return view('course_file.show',$data);
    }
    public function download(Request $request)
    {
        $coursefile = CourseFile::orderBy('created_at','DESC')->first();
        $file = $coursefile->file;


        $filePath = "public/course_file/$file";
        $fileName = $file;
        $fileSize = Storage::size($filePath);
        $mimeType = Storage::mimeType($filePath);
        $headers = ['Content-Type' => $mimeType];
        return Storage::download($filePath, $fileName, $headers);



    }
}
