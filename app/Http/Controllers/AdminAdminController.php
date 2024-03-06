<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminAdminController extends Controller
{
    public function index()
    {
        $currentUserId = Auth::id();
        $positionObject = DB::table('admins')->select('position')->where('user_id', $currentUserId)->first();
        $position = $positionObject->position;

        $admins = Admin::with('lastModifiedByAdmin.user')
            ->join('users', 'admins.user_id', '=', 'users.id')
            ->select('admins.*', 'users.name', 'users.email')
            ->where('admins.position', '>', $position)
            ->orderBy('admins.id', 'ASC')
            ->get();

        $data = ['admins' => $admins];
        return view('admins.admins.index', $data);
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
        Admin::create($request->all());
        return redirect()->route('admins.admins.index');
    }

    public function store_level(Request $request)
    {
        $user_id = $request->input('user_id');
        $position = $request->input('position');

        $adminId = Auth::user()->admin->id;
        Admin::create([
            'user_id' => $user_id,
            'position' => $position,
            'last_modified_by' => $adminId,
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
        if($request->position=="0")
            $admin->delete();
        else
            $adminId = Auth::user()->admin->id;
            $admin->update(array_merge($request->all(), ['last_modified_by' => $adminId]));
        return redirect()->route('admins.admins.index');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.admins.index');
    }

    public function search()
    {
        return view('selectview');
//        $user = User::where('account',$request)->first();
//        $data = [
//            'user' => $user,
//        ];
//        return view('admins.admins.create_selected',$data);
    }
}
