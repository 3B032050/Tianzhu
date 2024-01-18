<?php

namespace App\Http\Controllers;

use App\Models\CurriculumCategory;
use App\Http\Requests\StoreCurriculumCategoryRequest;
use App\Http\Requests\UpdateCurriculumCategoryRequest;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.curriculum_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurriculumCategoryRequest $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        CurriculumCategory::create($request->all());
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

        $curriculumCategory->update($request->all());
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
}
