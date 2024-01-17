<?php

namespace App\Http\Controllers;

use App\Models\CommonSense;
use App\Models\CommonSenseCategory;
use Illuminate\Http\Request;

class CommonSenseController extends Controller
{
    public function index(Request $request)
    {
        $categories = CommonSenseCategory::all();

        return view('common_senses.index', compact('categories'));
    }

    public function show($common_sense_category_id)
    {
        $selectedCategory = CommonSenseCategory::find($common_sense_category_id);
        $common_senses = CommonSense::where('common_sense_category_id', $common_sense_category_id)->get();

        $data = [
            'common_senses'=> $common_senses,
            'selectedCategory' => $selectedCategory,
        ];

        return view('common_senses.show', $data);
    }

    public function show_content($common_sense_id)
    {
        $common_sense = CommonSense::where('id', $common_sense_id)->first();
        $data = [
            'common_sense'=> $common_sense,
        ];

        return view('common_senses.show_content', $data);
    }

    public function search(Request $request)
    {

    }
}
