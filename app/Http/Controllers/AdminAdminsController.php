<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAdminsController extends Controller
{
    public function index()
    {
        $admins = DB::table('admins')
            ->join('users', 'admins.user_id', '=', 'users.id')
            ->select('admins.*', 'users.name', 'users.email') // 選擇需要的使用者資料
            ->orderBy('admins.id', 'ASC')
            ->get();
        $data = ['admins' => $admins];
        return view('admins.admins.index',$data);
    }

    public function create()
    {
        $admins = Admin::pluck('user_id')->toArray();
        $users = User::whereNotIn('id',$admins)->orderBy('id','ASC')->get();
        $data = ['users' => $users];
        return view('admins.admins.create',$data);

    }

    public function create_selcted($user)
    {
        $admins = Admin::pluck('user_id')->toArray();
        $users = User::whereNotIn('id',$admins)->orderBy('id','ASC')->get();
        $user = User::where('id',$user)->first();
        $data = [
            'users' => $users,
            'user' => $user,
        ];
        return view('admins.admins.create_selected',$data);
    }

    public function store(Request $request)
    {
//        $this->validate($request,[
//            'title' => 'required|max:50',
//            'content' => 'required',
//            'is_feature' => 'required|boolean',
//        ]);

        Admin::create($request->all());
        return redirect()->route('admins.admins.index');
    }

    public function store_level(Request $request)
    {
        $user_id = $request->input('user_id');
        $position = $request->input('position');


        Admin::create([
            'user_id' => $user_id,
            'position' => $position,
        ]);
        return redirect()->route('admins.admins.index');
    }


    public function edit($adminid)
    {
        $user = User::where('id',$adminid)->first();
        $admin = Admin::where('user_id',$adminid)->first();
//        $admin = User::find($admin->user_id);
        $data = [
            'admin' => $admin,
            'user'=> $user,
        ];
        return view('admins.admins.edit',$data);
    }

    public function update(Request $request, Admin $admin)
    {
//        $this->validate($request,[
//            'title' => 'required|max:50',
//            'content' => 'required',
//            'is_feature' => 'required|boolean',
//        ]);
        if($request->position=="0")
            $admin->delete();
        else
            $admin->update($request->all());
        return redirect()->route('admins.admins.index');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.admins.index');
    }
}
