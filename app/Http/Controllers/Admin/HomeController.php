<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user();
        // // accede agli attriuti di userInfo
        // dd($user->userInfo);

        $data = [
            'user' => $user,
            'userInfo' => $user->userInfo
        ];

        return view('admin.home', $data);
    }
}
