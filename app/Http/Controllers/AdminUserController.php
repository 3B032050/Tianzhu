<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\UserClassification;
use Illuminate\Http\Request;

class AdminUserController extends Controller
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
        $classifications = UserClassification::get();
        $data = ['classifications' => $classifications];
        return view('admins.users.create',$data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'account' => 'required', 'string', 'max:255',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'name' => 'required', 'string', 'max:255',
            'sex' => 'required', 'string', 'max:1',
            'email' => 'required|email|unique:users,email',
            'birthday' => 'required', 'date',
            'phone' => 'required', 'string', 'max:10',
            'address' => 'required', 'string', 'max:255',
            'classification' => 'required', 'string',
        ]);

        User::create($request->all());
        return redirect()->route('admins.users.index');
    }

    public function edit(User $user)
    {
        $classifications = UserClassification::get();
        $data = [
            'user'=> $user, 'classifications' => $classifications,
        ];
        return view('admins.users.edit',$data);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'account' => 'required', 'string', 'max:255',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'name' => 'required', 'string', 'max:255',
            'sex' => 'required', 'string', 'max:1',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'birthday' => 'required', 'date',
            'phone' => 'required', 'string', 'max:10',
            'address' => 'required', 'string', 'max:255',
            'classification' => 'required', 'string',
        ]);

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
