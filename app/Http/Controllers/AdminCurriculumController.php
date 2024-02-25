<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Http\Requests\StoreCurriculumRequest;
use App\Http\Requests\UpdateCurriculumRequest;
use App\Models\CurriculumCategory;
use App\Models\CurriculumMethod;
use App\Models\CurriculumObjective;

class AdminCurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curriculumCategories = CurriculumCategory::orderBy('id', 'ASC')->get();
        $curricula = Curriculum::orderby('id','ASC')->get();
        $data = ['curricula' => $curricula,
        'curriculumCategories' => $curriculumCategories];
        return view('admins.curricula.index',$data);
    }

    public function selected(CurriculumCategory $curriculumCategory)
    {
        $curriculumCategories = CurriculumCategory::orderBy('id', 'ASC')->get();
        $curricula = Curriculum::where('curriculum_category_id', $curriculumCategory->id)->get();

        $data = [
            'curricula' => $curricula,
            'curriculumCategories' => $curriculumCategories
        ];

        return view('admins.curricula.selected', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $curriculum_categories = CurriculumCategory::get();
        $curriculum_objectives = CurriculumObjective::get();
        $curriculum_methods = CurriculumMethod::get();

        // 將數據添加到 $data 陣列中
        $data = [
            'curriculum_categories' => $curriculum_categories,
            'curriculum_methods' => $curriculum_methods,
            'curriculum_objectives' => $curriculum_objectives,
        ];

        return view('admins.curricula.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurriculumRequest $request)
    {
        // 驗證表單輸入
        $request->validate([
            'title' => 'required|string',
            'method' => 'nullable|max:255',
            'content' => 'required',
            'curriculum_category' => 'required|exists:curriculum_categories,id',
            'curriculum_methods' => 'array',
            'curriculum_objectives' => 'array',
        ]);

        // 創建課程
        $curriculum = new Curriculum();
        $curriculum->title = $request->input('title');
        $curriculum->curriculum_category_id = $request->input('curriculum_category');
        $curriculum->content = $request->input('content');
        $curriculum->method = $request->input('method');
        $curriculum->status = 0;


        // 儲存課程
        $curriculum->save();

        // 將方法關聯到中介表格
        $curriculum->methods()->sync($request->input('curriculum_methods'));

        // 將目標關聯到中介表格
        $curriculum->objectives()->sync($request->input('curriculum_objectives'));

        return redirect()->route('admins.curricula.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Curriculum $curriculum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curriculum $curriculum)
    {
        $curriculum_categories = CurriculumCategory::all();
        $curriculum_methods = CurriculumMethod::all();
        $curriculum_objectives = CurriculumObjective::all();

        $selectedMethods = $curriculum->methods->pluck('id')->toArray();
        $selectedObjectives = $curriculum->objectives->pluck('id')->toArray();

        $data = [
            'curriculum' => $curriculum,
            'curriculum_categories' => $curriculum_categories,
            'curriculum_methods' => $curriculum_methods,
            'curriculum_objectives' => $curriculum_objectives,
            'selectedMethods' => $selectedMethods,
            'selectedObjectives' => $selectedObjectives,
        ];

        return view('admins.curricula.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCurriculumRequest $request, Curriculum $curriculum)
    {
        $request->validate([
            'title' => 'required|max:50',
            'method' => 'nullable|max:255',
            'content' => 'required',
            'curriculum_category' => 'required|exists:curriculum_categories,id',
            'curriculum_methods' => 'array',
            'curriculum_objectives' => 'array',
        ]);

        // Update the Course model
        $curriculum->update([
            'title' => $request->input('title'),
            'method' => $request->input('method'),
            'content' => $request->input('content'),
            'curriculum_category_id' => $request->input('curriculum_category'),
        ]);

        // Sync the related methods
        $curriculum->methods()->sync($request->input('curriculum_methods', []));

        // Sync the related objectives
        $curriculum->objectives()->sync($request->input('curriculum_objectives', []));

        return redirect()->route('admins.curricula.index');
    }

    public function status_off(Curriculum $curriculum)
    {
        $curriculum->status='0';
        $curriculum->save();
        return redirect()->route('admins.curricula.index');
    }
    public function status_on(Curriculum $curriculum)
    {
        $curriculum->status='1';
        $curriculum->save();
        return redirect()->route('admins.curricula.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curriculum $curriculum)
    {
        $curriculum->delete();
        return redirect()->route('admins.curricula.index');
    }
}
