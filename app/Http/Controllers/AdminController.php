<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getData(Request $req)
    {
        $data = null;
        $maxPageLimit = 10;
        $totalData = User::count();
        if ($totalData > $maxPageLimit) {
            $data = User::paginame($maxPageLimit);
        } else {
            $data = User::all();
        }
        $admin = Admin::where('email', 'sayan@gmail.com')
            ->where('password', 'password123')
            ->first();

        return view('cms.dashboard', ['users' => $data, "maxPageLimit" => $maxPageLimit, "totalData" => $totalData, "admin" => $admin]);
    }
}
