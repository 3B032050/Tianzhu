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

    public function search(Request $request)
    {
        $selectedCommonSenses = [];

        if ($request->input('query')) {
            $query = $request->input('query');
            $searchOption = $request->input('search_option');

            // 根據用戶選擇的選項來進行搜尋
            if ($searchOption == 'title') {
                $selectedCommonSenses = CommonSense::where('status', 1)
                    ->where('title', 'LIKE', '%' . $query . '%')
                    ->get();
            } elseif ($searchOption == 'content') {
                $selectedCommonSenses = CommonSense::where('status', 1)
                    ->where('content', 'LIKE', '%' . $query . '%')
                    ->get();
            }
        }

        $data = ['selectedCommonSenses' => $selectedCommonSenses];
        return view('common_senses.search', $data);
    }

    public function show_search_content($common_sense_id)
    {
        $common_sense = CommonSense::where('id', $common_sense_id)->first();
        $data = [
            'common_sense'=> $common_sense,
        ];

        return view('common_senses.show_search_content', $data);
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


}
