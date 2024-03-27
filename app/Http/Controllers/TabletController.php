<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TabletController extends Controller
{
    public function index()
    {
        return view('tablets.index');
    }

    public function create_blessing()
    {
        return view('tablets.create_blessing');
    }

    public function select_delivering_the_decreased()
    {
        return view('tablets.select_delivering_the_decreased');
    }

    public function create_delivering_the_decreased(Request $request)
    {
        // 根據用戶勾選的欄位動態生成對應的輸入欄位數量
        $columns = $request->input('columns', []);

        // 姓名輸入欄位
        $nameInputs = 0;
        if (in_array('姓名', $columns)) {
            $nameInputs += 15;
        }

        // 歷代祖先輸入欄位
        $ancestorInputs = 0;
        if (in_array('歷代祖先', $columns)) {
            $ancestorInputs += 2;
            $nameInputs -= 6;
        }

        // 冤親債主輸入欄位
        $debtInputs = 0;
        if (in_array('冤親債主', $columns)) {
            $debtInputs += 1;
            $nameInputs -= 3;
        }

        // 地基主輸入欄位
        $landlordInputs = 0;
        if (in_array('地基主', $columns)) {
            $landlordInputs += 1;
            $nameInputs -= 3;
        }

        $yangShangInputs = 4;

        // 將生成的輸入欄位傳遞給視圖
        return view('tablets.create_delivering_the_decreased', compact('nameInputs', 'ancestorInputs', 'debtInputs', 'landlordInputs','yangShangInputs'));
    }
}
