<?php

namespace App\Http\Controllers;

use App\Models\CommonSense;
use App\Models\CommonSenseCategory;
use Illuminate\Http\Request;

class CommonSenseController extends Controller
{
    public function index(Request $request)
    {
        $categories = CommonSenseCategory::where('status', 1)->get();

        return view('common_senses.index', compact('categories'));
    }

    public function show($common_sense_category_id)
    {
        $selectedCategory = CommonSenseCategory::find($common_sense_category_id);

        // 只抓取 status 為 1 的 CommonSense
        $common_senses = CommonSense::where('common_sense_category_id', $common_sense_category_id)
            ->where('status', 1)
            ->get();

        $data = [
            'common_senses'=> $common_senses,
            'selectedCategory' => $selectedCategory,
        ];

        return view('common_senses.show', $data);
    }

    public function show_content($common_sense_id,$common_sense_category_id)
    {
        $selectedCategory = CommonSenseCategory::find($common_sense_category_id);
        $common_sense = CommonSense::where('id', $common_sense_id)->first();
        $data = [
            'common_sense'=> $common_sense,
            'selectedCategory' => $selectedCategory,
        ];

        return view('common_senses.show_content', $data);
    }

    public function search(Request $request)
    {

    }
}
