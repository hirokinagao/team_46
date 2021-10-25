<?php

// 柳田専用

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //テスト用メソッド
    public function admin()
    {
        return view ('admin');
    }
}
