<?php

namespace App\Http\Controllers;

use App\Models\CurriculumMethod;
use App\Http\Requests\StoreCurriculumMethodRequest;
use App\Http\Requests\UpdateCurriculumMethodRequest;

class AdminCurriculumMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curriculumMethods = CurriculumMethod::orderBy('id', 'ASC')->get();
        $data = ['curriculumMethods' => $curriculumMethods];
        return view('admins.curriculum_methods.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.curriculum_methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurriculumMethodRequest $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        CurriculumMethod::create($request->all());
        return redirect()->route('admins.curriculum_methods.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CurriculumMethod $curriculumMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CurriculumMethod $curriculumMethod)
    {
        $data = [
            'curriculumMethod'=> $curriculumMethod,
        ];
        return view('admins.curriculum_methods.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCurriculumMethodRequest $request, CurriculumMethod $curriculumMethod)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        $curriculumMethod->update($request->all());
        return redirect()->route('admins.curriculum_methods.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CurriculumMethod $curriculumMethod)
    {
        $curriculumMethod->delete();
        return redirect()->route('admins.curriculum_methods.index');
    }
}
