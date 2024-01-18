<?php

namespace App\Http\Controllers;

use App\Models\Introduction;
use Illuminate\Http\Request;

class IntroductionController extends Controller
{
    public function show(Introduction $introduction)
    {
        $data = ['introduction' => $introduction];

        return view('introductions.show',$data);
    }
}
