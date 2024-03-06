<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserClassification;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('id',auth()->user()->id)->first();
        $classifications = UserClassification::get();
        $data = ['user' => $user , 'classifications' => $classifications];
        return view('users.index',$data);
    }

    public function create()
    {
        return view('admins.users.create');
    }

    public function store(Request $request)
    {
//        $this->validate($request,[
//            'title' => 'required|max:50',
//            'content' => 'required',
//            'is_feature' => 'required|boolean',
//        ]);

        User::create($request->all());
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $data = [
            'user'=> $user,
        ];
        return view('admins.users.edit',$data);
    }


    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:1'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'birthday' => ['required', 'date',],
            'phone' => ['required', 'string', 'max:10'],
            'cityline' => ['max:10'],
            'address' => ['max:255'],
            'classification' => ['required', 'string'],
        ]);

        $user->update($request->all());
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admins.users.index');
    }
}
