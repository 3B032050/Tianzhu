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
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        CommonSenseCategory::create($request->all());
        return redirect()->route('admins.common_sense_categories.index');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommonSenseCategory $commonSenseCategory)
    {
        $commonSenseCategory->delete();
        return redirect()->route('admins.common_sense_categories.index');
    }
}
