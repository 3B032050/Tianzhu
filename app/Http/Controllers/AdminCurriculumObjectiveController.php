<?php

namespace App\Http\Controllers;

use App\Models\CurriculumObjective;
use App\Http\Requests\StoreCurriculumObjectiveRequest;
use App\Http\Requests\UpdateCurriculumObjectiveRequest;

class AdminCurriculumObjectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curriculumObjectives = CurriculumObjective::orderBy('id', 'ASC')->get();
        $data = ['curriculumObjectives' => $curriculumObjectives];
        return view('admins.curriculum_objectives.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.curriculum_objectives.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurriculumObjectiveRequest $request)
    {
        $this->validate($request,[
            'description' => 'required|max:255',
        ]);

        CurriculumObjective::create($request->all());
        return redirect()->route('admins.curriculum_objectives.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CurriculumObjective $curriculumObjective)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CurriculumObjective $curriculumObjective)
    {
        $data = [
            'curriculumObjective'=> $curriculumObjective,
        ];
        return view('admins.curriculum_objectives.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCurriculumObjectiveRequest $request, CurriculumObjective $curriculumObjective)
    {
        $this->validate($request,[
            'description' => 'required|max:255',
        ]);

        $curriculumObjective->update($request->all());
        return redirect()->route('admins.curriculum_objectives.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CurriculumObjective $curriculumObjective)
    {
        $curriculumObjective->delete();
        return redirect()->route('admins.curriculum_objectives.index');
    }
}
