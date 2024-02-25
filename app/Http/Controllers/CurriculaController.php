<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\CurriculumCategory;
use Illuminate\Http\Request;

class CurriculaController extends Controller
{
    public function index(Request $request)
    {
        $categories = CurriculumCategory::orderBy('parent_id','DESC')->get();
        $curricula = Curriculum::where('status', 1)->get();

        $data = [
            'categories'=> $categories,
            'curricula' => $curricula,
        ];

        return view('curricula.index', $data);
    }

    public function show(curriculum $curriculum)
    {
        $selectedCategory = CurriculumCategory::where('id',$curriculum->curriculum_category_id	)->first();
        $curriculum = Curriculum::where('id',$curriculum->id)->first();
        $data = ['curriculum' => $curriculum,
            'selectedCategory' => $selectedCategory];

        return view('curricula.show',$data);
    }
}
