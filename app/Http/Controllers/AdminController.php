<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admins.dashboard.index');
    }

    public function home()
    {
        return view('admins.dashboard.index');
    }
}
