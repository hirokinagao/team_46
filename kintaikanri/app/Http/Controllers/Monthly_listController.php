<?php

// 長尾専用

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Monthly_listController extends Controller
{


    public function monthly_list()
    {
        $users = DB::table('work_times')->get();
        //①テーブルの4項目（開始時間など）を一つのカラムにまとめる（タイプはDateTime）
        //②データを用意する　例：2021-11-01　10：11：12
        //③上記が終わったらContorollerを修正する

        return view('monthly_list', ['users' => $users]);
    }

}



