<?php

namespace App\Http\Controllers;

use App\Models\CurriculumCategory;
use App\Http\Requests\StoreCurriculumCategoryRequest;
use App\Http\Requests\UpdateCurriculumCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminCurriculumCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curriculumCategories = CurriculumCategory::orderBy('id', 'ASC')->get();
        $data = ['curriculumCategories' => $curriculumCategories];
        return view('admins.curriculum_categories.index', $data);
    }

    public function order_by()
    {
        $curriculumCategories = CurriculumCategory::orderBy('order_by')->get();
        $data = ['curriculumCategories' => $curriculumCategories];
        return view('admins.curriculum_categories.order_by', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.curriculum_categories.create');
    }

    public function create_hierarchy(CurriculumCategory $curriculumCategory)
    {
//        $web_hierarchy = CurriculumCategory::where('parent_id',$parent_id)->first();
        $data = ['curriculumCategory' => $curriculumCategory];
        return view('admins.curriculum_categories.create_hierarchy', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurriculumCategoryRequest $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        // Check if parent_id exists in the request
        if ($request->has('parent_id')) {
            $requestData = $request->all();
        } else {
            $requestData = array_merge($request->all(), ['parent_id' => 0]);
        }
        $order_by = CurriculumCategory::max('order_by') + 1;
        $adminId = Auth::user()->admin->id;
        // Create the CurriculumCategory
        CurriculumCategory::create(array_merge($requestData, ['last_modified_by' => $adminId, 'order_by' => $order_by]));

        return redirect()->route('admins.curriculum_categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CurriculumCategory $curriculumCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CurriculumCategory $curriculumCategory)
    {
        $data = [
            'curriculumCategory'=> $curriculumCategory,
        ];
        return view('admins.curriculum_categories.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCurriculumCategoryRequest $request, CurriculumCategory $curriculumCategory)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        $adminId = Auth::user()->admin->id;
        $curriculumCategory->update(array_merge($request->all(), ['last_modified_by' => $adminId]));
        return redirect()->route('admins.curriculum_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CurriculumCategory $curriculumCategory)
    {
        $curriculumCategory->delete();
        return redirect()->route('admins.curriculum_categories.index');
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
                CurriculumCategory::where('id', $itemId)->update(['order_by' => $index + 1]);
            }

            return redirect()->route('admins.curriculum_categories.order_by');
        }

        return redirect()->route('admins.curriculum_categories.order_by');
    }
}
