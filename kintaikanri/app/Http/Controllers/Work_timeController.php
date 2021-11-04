<?php

// 宮内専用

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Work_timeController extends Controller
{
    //テスト用メソッド
    public function work_time()
    {
        return view ('work_time');
    }
}
