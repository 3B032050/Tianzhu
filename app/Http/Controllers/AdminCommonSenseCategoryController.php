<?php

namespace App\Http\Controllers;

use App\Models\CommonSense;
use App\Models\CommonSenseCategory;
use App\Http\Requests\StoreCommonSenseCategoryRequest;
use App\Http\Requests\UpdateCommonSenseCategoryRequest;

class AdminCommonSenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $common_sense_categories = CommonSenseCategory::orderBy('id', 'ASC')->get();
        $data = ['common_sense_categories' => $common_sense_categories];
        return view('admins.common_sense_categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.common_sense_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommonSenseCategoryRequest $request)
    {
        // 驗證表單輸入
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        // 檢查是否已經存在相同名稱的類別
        $existingCategory = CommonSenseCategory::where('name', $request->input('name'))->first();
        if ($existingCategory) {
            return redirect()->route('admins.common_sense_categories.index')->with('error', '類別名稱已經存在。');
        }

        $common_sense_category = new CommonSenseCategory();
        $common_sense_category->name = $request->input('name');
        $common_sense_category->status = 0;

        $common_sense_category->save();

        return redirect()->route('admins.common_sense_categories.index')->with('success', '類別名稱已成功新增。');
    }

    /**
     * Display the specified resource.
     */
    public function show(CommonSenseCategory $commonSenseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommonSenseCategory $commonSenseCategory)
    {
        $data = [
            'commonSenseCategory'=> $commonSenseCategory,
        ];
        return view('admins.common_sense_categories.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommonSenseCategoryRequest $request, CommonSenseCategory $commonSenseCategory)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        $commonSenseCategory->update($request->all());
        return redirect()->route('admins.common_sense_categories.index');
    }


    public function status_off(CommonSenseCategory $commonSenseCategory)
    {
        $commonSenseCategory->status='0';
        $commonSenseCategory->save();
        return redirect()->route('admins.common_sense_categories.index');
    }
    public function status_on(CommonSenseCategory $commonSenseCategory)
    {
        $commonSenseCategory->status='1';
        $commonSenseCategory->save();
        return redirect()->route('admins.common_sense_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommonSenseCategory $commonSenseCategory)
    {
        $commonSenseCategory->delete();
        return redirect()->route('admins.common_sense_categories.index');
    }
}
