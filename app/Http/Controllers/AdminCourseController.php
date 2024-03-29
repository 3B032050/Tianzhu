<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use App\Models\CourseMethod;
use App\Models\CourseObjective;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminCourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::orderby('id','ASC')->get();
        $course_categories = CourseCategory::get();
        $data = ['courses' => $courses , 'course_categories' => $course_categories];
        return view('admins.courses.index',$data);
    }

    public function by_category()
    {
        $courseCategories = CourseCategory::orderBy('order_by')->get();
        $data = ['courseCategories' => $courseCategories];
        return view('admins.courses.by_category', $data);
    }

    public function order_by(Request $request, $courseCategoryId)
    {
        $courseCategory = CourseCategory::findOrFail($courseCategoryId);
        $courses = Course::where('course_category_id', $courseCategoryId)->orderBy('order_by', 'ASC')->get();
        $data = ['courses' => $courses, 'courseCategory' => $courseCategory];
        return view('admins.courses.order_by', $data);
    }

    public function search(Request $request)
    {
        $course_categories = CourseCategory::get();
        $query = $request->input('query');
        $category = $request->input('category');


        if ($category != 'all')
        {
            $courses = Course::where('course_category_id', 'like', "%$category%")
                ->where('title','like',"%$query%")
                ->get();
        }
        else
        {
            $courses = Course::where('title', 'like', "%$query%")
                ->get();
        }

        $data = ['course_categories' => $course_categories , 'courses' => $courses , 'query' => $query , 'category' => $category];

        return view('admins.courses.index',$data);
    }

    public function create()
    {
        $course_categories = CourseCategory::get();
        $course_objectives = CourseObjective::get();
        $course_methods = CourseMethod::get();

        // 將數據添加到 $data 陣列中
        $data = [
            'course_categories' => $course_categories,
            'course_objectives' => $course_objectives,
            'course_methods' => $course_methods,
        ];

        return view('admins.courses.create',$data);
    }

    public function store(Request $request)
    {
        // 驗證表單輸入
        $request->validate([
            'title' => 'required|string',
            'method' => 'nullable|max:255',
            'course_category' => 'required|exists:course_categories,id',
            'course_methods' => 'array',
            'course_objectives' => 'array',
            'time' => 'nullable|max:255',
            'note' => 'nullable|max:255',
        ]);

        $existingCourse = Course::where('title', $request->input('title'))->first();
        if ($existingCourse) {
            return redirect()->route('admins.courses.index')
                ->withErrors(['title' => '課程名稱已存在'])
                ->withInput($request->all());
        }

        // 創建課程
        $course = new Course();
        $course->title = $request->input('title');
        $course->content = $request->input('content');
        $course->course_category_id = $request->input('course_category');
        $course->method = $request->input('method');
        $course->time = $request->input('time');
        $course->note = $request->input('note');
        $course->status = $request->input('status');

        $adminId = Auth::user()->admin->id;
        $course->last_modified_by = $adminId;

        $maxOrderBy = Course::where('course_category_id', $request->input('course_category'))->max('order_by');
        $courseOrderBy = $maxOrderBy + 1;
        $course->order_by = $courseOrderBy;

        // 儲存課程
        $course->save();

        // 將方法關聯到中介表格
        $course->methods()->sync($request->input('course_methods'));

        // 將目標關聯到中介表格
        $course->objectives()->sync($request->input('course_objectives'));

        return redirect()->route('admins.courses.index');
    }

    public function edit(Course $course)
    {
        $course_categories = CourseCategory::all();
        $course_methods = CourseMethod::all();
        $course_objectives = CourseObjective::all();

        $selectedMethods = $course->methods->pluck('id')->toArray();
        $selectedObjectives = $course->objectives->pluck('id')->toArray();

        $data = [
            'course' => $course,
            'course_categories' => $course_categories,
            'course_methods' => $course_methods,
            'course_objectives' => $course_objectives,
            'selectedMethods' => $selectedMethods,
            'selectedObjectives' => $selectedObjectives,
        ];

        return view('admins.courses.edit',$data);
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|max:50',
            'method' => 'nullable|max:255',
            'course_category' => 'required|exists:course_categories,id',
            'course_methods' => 'array',
            'course_objectives' => 'array',
            'time' => 'nullable|max:255',
            'note' => 'nullable|max:255',
        ]);

        $adminId = Auth::user()->admin->id;

        // Update the Course model
        $course->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'method' => $request->input('method'),
            'course_category_id' => $request->input('course_category'),
            'time' => $request->input('time'),
            'note' => $request->input('note'),
            'status' => $request->input('status'),
            'last_modified_by' => $adminId,
        ]);

        // Sync the related methods
        $course->methods()->sync($request->input('course_methods', []));

        // Sync the related objectives
        $course->objectives()->sync($request->input('course_objectives', []));

        return redirect()->route('admins.courses.index');
    }

    public function statusOn(Request $request, Course $course)
    {
        $adminId = Auth::user()->admin->id;
        $course->update(['status' => 1, 'last_modified_by' => $adminId]);
        return redirect()->route('admins.courses.index');
    }

    public function statusOff(Request $request, Course $course)
    {
        $adminId = Auth::user()->admin->id;
        $course->update(['status' => 0, 'last_modified_by' => $adminId]);
        return redirect()->route('admins.courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admins.courses.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            // Save the image in the storage/web_images folder
            Storage::disk('courses')->put($fileName, file_get_contents($request->file('upload')));

            $url = Storage::disk('courses')->url($fileName);

            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }

    public function update_order(Request $request)
    {
        // 使用 $request->input('sortedIds') 獲取排序的順序
        $sortedIds = $request->input('sortedIds');

        // 確保 $sortedIds 是字符串
        if (is_string($sortedIds)) {
            // 使用 explode 函數將字符串拆分成數組
            $sortedIdsArray = explode(',', $sortedIds);

            // 更新數據庫中的排序
            foreach ($sortedIdsArray as $index => $itemId) {
                Course::where('id', $itemId)->update(['order_by' => $index + 1]);
            }

            $courseCategoryId = Course::find($sortedIdsArray[0])->course_category_id;

            return redirect()->route('admins.courses.order_by', ['courseCategoryId' => $courseCategoryId]);
        }

        return redirect()->route('admins.courses.by_category');
    }
}
