<?php

// 宮内専用

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Facades\DB;


class EditController extends Controller
{
    //テスト用メソッド
    public function edit()
    {
        return view ('edit');
    }
}
