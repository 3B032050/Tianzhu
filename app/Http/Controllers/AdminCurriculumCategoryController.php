<?php

namespace App\Http\Controllers;

use App\Models\CurriculumCategory;
use App\Http\Requests\StoreCurriculumCategoryRequest;
use App\Http\Requests\UpdateCurriculumCategoryRequest;
use Illuminate\Support\Facades\Auth;

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

        $adminId = Auth::user()->admin->id;
        // Create the CurriculumCategory
        CurriculumCategory::create(array_merge($requestData, ['last_modified_by' => $adminId]));

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
}
