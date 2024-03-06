<?php

namespace App\Http\Controllers;

use App\Models\CommonSense;
use App\Http\Requests\StoreCommonSenseRequest;
use App\Http\Requests\UpdateCommonSenseRequest;
use App\Models\CommonSenseCategory;
use Illuminate\Support\Facades\Auth;

class AdminCommonSenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commonSenseCategories = CommonSenseCategory::orderBy('id', 'ASC')->get();
        $common_senses = CommonSense::orderby('id','ASC')->get();
        $data = ['common_senses' => $common_senses,
        'commonSenseCategories' => $commonSenseCategories];
        return view('admins.common_senses.index',$data);
    }

    public function selected(CommonSenseCategory $commonSenseCategory)
    {
        $commonSenseCategories = CommonSenseCategory::orderBy('id', 'ASC')->get();
        $common_senses = CommonSense::where('common_sense_category_id', $commonSenseCategory->id)->get();

        $data = [
            'common_senses' => $common_senses,
            'commonSenseCategories' => $commonSenseCategories
        ];

        return view('admins.common_senses.selected', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $common_sense_categories = CommonSenseCategory::get();

        // 將數據添加到 $data 陣列中
        $data = [
            'common_sense_categories' => $common_sense_categories,
        ];

        return view('admins.common_senses.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommonSenseRequest $request)
    {
        // 驗證表單輸入
        $request->validate([
            'title' => 'required|string',
            'common_sense_category' => 'required|exists:common_sense_categories,id',
            'content' => 'required',
        ]);


        $common_sense = new CommonSense();
        $common_sense->title = $request->input('title');
        $common_sense->common_sense_category_id = $request->input('common_sense_category');
        $common_sense->content = $request->input('content');
        $common_sense->status = 0;

        $adminId = Auth::user()->admin->id;
        $common_sense->last_modified_by = $adminId;

        $common_sense->save();

        return redirect()->route('admins.common_senses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CommonSense $commonSense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommonSense $commonSense)
    {
        $common_sense_categories = CommonSenseCategory::all();


        $data = [
            'commonSense' => $commonSense,
            'common_sense_categories' => $common_sense_categories,
        ];

        return view('admins.common_senses.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommonSenseRequest $request, CommonSense $commonSense)
    {
        $request->validate([
            'title' => 'required|string',
            'common_sense_category' => 'required|exists:common_sense_categories,id',
            'content' => 'required',
        ]);

        $adminId = Auth::user()->admin->id;

        $commonSense->update([
            'title' => $request->input('title'),
            'common_sense_category_id' => $request->input('common_sense_category'),
            'content' => $request->input('content'),
            'last_modified_by' => $adminId,
        ]);

        return redirect()->route('admins.common_senses.index');
    }

    public function status_off(CommonSense $commonSense)
    {
        $commonSense->status='0';
        $commonSense->save();
        return back();
    }
    public function status_on(CommonSense $commonSense)
    {
        $commonSense->status='1';
        $commonSense->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommonSense $commonSense)
    {
        $commonSense->delete();
        return redirect()->route('admins.common_senses.index');
    }
}
