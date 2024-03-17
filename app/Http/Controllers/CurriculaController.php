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
        $curricula = Curriculum::where('status', 1)->orderBy('order_by', 'asc')->get();

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

    public function search(Request $request)
    {
        if ($request->has('query')) {
            $query = $request->input('query');
            $searchOption = $request->input('search_option', 'title');

            $selectedCurricula = Curriculum::where('status', 1);

            if ($searchOption === 'title') {
                $selectedCurricula->where('title', 'LIKE', '%' . $query . '%')->orderBy('order_by', 'asc');
            } elseif ($searchOption === 'content') {
                $selectedCurricula->where('content', 'LIKE', '%' . $query . '%')->orderBy('order_by', 'asc');
            }

            $selectedCurricula = $selectedCurricula->get();
        } else {
            $selectedCurricula = [];
        }

        $data = ['selectedCurricula' => $selectedCurricula];
        return view('curricula.search', $data);
    }
}
