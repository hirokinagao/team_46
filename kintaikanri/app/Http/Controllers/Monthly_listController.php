<?php

// 長尾専用

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Monthly_listController extends Controller
{
    public function monthly_list(Request $request)
    {
        //$requestの情報を代入
        $id = $request->session()->get('id');
        $name = $request->session()->get('name');
        $role = $request->session()->get('role');
        $work_id = $request->session()->get('work_id');
        //☆idがなかった場合 ⇒ ※下記の★に関して管理者画面以外の画面はこちらの☆のコードが必要(アドレス直打ちでのブラウザ表示を拒否するため)
        if(empty($id)){
            return redirect('login');
        }
        //DBと照合してデータ検索
        $users = DB::table('work_times')->get();
            //①テーブルの4項目（開始時間など）を一つのカラムにまとめる（タイプはDateTime）
            //②データを用意する 例：2021-11-01 10：11：12
            //③上記が終わったらContorollerを修正する
        $view = view('monthly_list', [    //blade読み込み ⇒ (各画面ごとに、この行のコードを変更して使う)
            'users' => $users, //社員一覧データ ⇒ (各画面ごとに、この行のコードを変更して使う)
            'user_name' => $name, //ここから下3つはheader用に渡すデータ(各画面共通)
            'user_role' => $role,
            'work_id' => $work_id,
        ]);
        return $view;
    }



}



