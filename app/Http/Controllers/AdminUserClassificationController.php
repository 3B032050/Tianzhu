<?php

namespace App\Http\Controllers;

use App\Models\UserClassification;
use Illuminate\Http\Request;

class AdminUserClassificationController extends Controller
{
    public function index()
    {
        $userClassifications = UserClassification::orderBy('id', 'ASC')->get();
        $data = ['userClassifications' => $userClassifications];
        return view('admins.user_classifications.index', $data);
    }

    public function create()
    {
        return view('admins.user_classifications.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        UserClassification::create($request->all());
        return redirect()->route('admins.user_classifications.index');
    }

    public function edit(UserClassification $userClassification)
    {
        $data = [
            'userClassification'=> $userClassification,
        ];
        return view('admins.user_classifications.edit',$data);
    }

    public function update(Request $request, UserClassification $userClassification)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        $userClassification->update($request->all());
        return redirect()->route('admins.user_classifications.index');
    }

    public function destroy(UserClassification $userClassification)
    {
        $userClassification->delete();
        return redirect()->route('admins.user_classifications.index');
    }
}
