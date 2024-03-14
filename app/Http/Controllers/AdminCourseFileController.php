<?php

namespace App\Http\Controllers;

use App\Models\CourseFile;
use App\Models\CourseFileCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminCourseFileController extends Controller
{
    public function index(Request $request)
    {
        $coursefiles = CourseFile ::orderby('id','ASC')->get();
        $data = ['coursefiles' => $coursefiles];
        return view('admins.course_file.index',$data);
    }


    public function create(Request $request)
    {
        $course_file_categories =CourseFileCategory::orderby('id','ASC')->get();
        $data = ['course_file_categories' => $course_file_categories];
        return view('admins.course_file.create',$data);
    }

    public function store(Request $request)
    {
        // 驗證請求...
        $this->validate($request, [
            'title' => 'required|max:25',
            'file' => 'required|file', // 更新文件验证规则
        ]);

        $coursefile = new CourseFile;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            // 存儲原始圖片
            // 请确保你已经在 config/filesystems.php 中配置了 'course_file' 磁盘
            Storage::disk('course_file')->put($fileName, file_get_contents($file));

            // 更新下面的字段，将文件名存储到数据库而不是整个文件对象
            $coursefile->file = $fileName;
        }
        $coursefile->course_file_category_id = $request->course_file_category_id;
        $coursefile->title = $request->title;
        $coursefile->status = $request->input('status');

        $adminId = Auth::user()->admin->id;
        $coursefile->last_modified_by = $adminId;

        $coursefile->save();

        return redirect()->route('admins.course_file.index');
    }

    public function edit(CourseFile $coursefile)
    {
        $course_file_categories =CourseFileCategory::orderby('id','ASC')->get();
        $data = [
            'coursefile'=> $coursefile,'course_file_categories' => $course_file_categories
        ];
        return view('admins.course_file.edit',$data);
    }


    public function update(Request $request,CourseFile $coursefile)
    {
        $this->validate($request, [
            'title' => 'required|max:25',


        ]);

        if ($request->hasFile('file')) {
            // Delete the old image from storage
            if ($coursefile->file) {
                Storage::disk('course_file')->delete($coursefile->file);
            }


            // Upload the new image
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            // Log the image file name

            Storage::disk('course_file')->put($fileName, file_get_contents($file));

            // Set the new image URL in the Product instance
            $coursefile->file = $fileName;
        }
        $coursefile->title = $request->title;
        $coursefile->status = $request->input('status');
        $adminId = Auth::user()->admin->id;
        $coursefile->last_modified_by = $adminId;

        $coursefile->save();

        return redirect()->route('admins.course_file.index');
    }
    public function statusoff(CourseFile $coursefile)
    {
        $adminId = Auth::user()->admin->id;
        $coursefile->last_modified_by = $adminId;
        $coursefile->status='0';
        $coursefile->save();
        return back();
    }
    public function statuson(CourseFile $coursefile)
    {
        $adminId = Auth::user()->admin->id;
        $coursefile->last_modified_by = $adminId;
        $coursefile->status='1';
        $coursefile->save();
        return back();
    }


    public function destroy(CourseFile $coursefile)
    {
        $coursefile->delete();
        return redirect()->route('admins.course_file.index');
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $category = $request->input('category');
        $perPage = $request->input('perPage', 10);

        $query = CourseFile::with('coursefilecategory');

        if ($category == 'title') {
            $query->where('title', 'like', "%$searchTerm%");
        } elseif ($category == 'category') {
            $query->whereHas('coursefilecategory', function ($query) use ($searchTerm) {
                $query->where('course_file_category_name', 'like', "%$searchTerm%");
            });
        }

        $coursefiles = $query->orderBy('id', 'ASC')->paginate($perPage);

        return view('admins.course_file.index', [
            'coursefiles' => $coursefiles,
            'query' => $searchTerm,
            'category' => $category,
        ]);
    }
}
