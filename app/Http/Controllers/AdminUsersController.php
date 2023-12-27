<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $users = User::orderby('id','ASC')->paginate($perPage);
        $data = ['users' => $users];
        return view('admins.users.index',$data);
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
        return redirect()->route('admins.users.index');
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
//        $this->validate($request,[
//            'title' => 'required|max:50',
//            'content' => 'required',
//            'is_feature' => 'required|boolean',
//        ]);

        $user->update($request->all());
        return redirect()->route('admins.users.index');
    }

    public function destroy(User $user)
    {
        $admin = Admin::where('user_id', $user->id)->first();
        if ($admin) {
            $admin->delete();
        }
        $user->delete();
        return redirect()->route('admins.users.index');
    }

    public function search(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $query = $request->input('query');

        // 搜尋會員資料
        $users = User::where('account', 'like', "%$query%")
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('name', 'like', '%' . $query . '%')
            ->orWhere('sex', 'like', '%' . $query . '%')
            ->orWhere('phone', 'like', '%' . $query . '%')
//            ->orWhereHas('admin', function ($adminQuery) use ($query) {
//                $adminQuery->where('position', 'like', '%' . $query . '%');
//            })
            ->paginate($perPage);

        // 返回結果
        return view('admins.users.index', [
            'users' => $users,
            'query' => $query,
        ]);
    }
}
