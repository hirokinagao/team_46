<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //テスト用メソッド
    public function test()
    {
        return view ('admin');
    }
}
