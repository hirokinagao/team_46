<?php

// 柳田専用

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * 管理者画面表示 ⇒ (他画面の画面表示に関しては、このメソッドをひな型として一部変更して使用)
     * 
     * @param Request $request ⇒ここの$requestはsessionのデータ
     * @return Response
     */
    public function admin(Request $request)
    {
        //$requestの情報を代入
        $id = $request->session()->get('id');
        $name = $request->session()->get('name');
        $role = $request->session()->get('role');
        $work_id = $request->session()->get('work_id');

        //☆idがなかった場合 ⇒ ※下記の★に関して管理者画面以外の画面はこちらの☆のコードが必要(アドレス直打ちでのブラウザ表示を拒否するため)
        // if(empty($id)){
        //     return redirect('login');
        // }

        //★管理者かの確認(管理者画面のみの仕様)(アドレス直打ちでのブラウザ表示を拒否するため)
        if (empty($id) && empty($role)) {
            return redirect('login');
        } else {
            if ($role != 1) {
                return redirect('login');
            }
        }

        //DBと照合してデータ検索
        $users_list = DB::table('users')->get();  //userテーブルの情報を全てとってくる（社員一覧に必要なデータ） ⇒ (各画面ごとに、この行のコードを変更して使う)
        $view = view('admin', [    //blade読み込み ⇒ (各画面ごとに、この行のコードを変更して使う)
            'users_list' => $users_list, //社員一覧データ ⇒ (各画面ごとに、この行のコードを変更して使う)
            'user_name' => $name, //ここから下3つはheader用に渡すデータ(各画面共通)
            'user_role' => $role,
            'work_id' => $work_id,
        ]);
        return $view;
    }


    /**
     * 検索機能(検索結果は同じbladeに表示)
     * 
     * @param Request $request ⇒ここの$requestは検索欄に入力されたdetaとsession情報
     * @return Response
     */
    public function search(Request $request) 
    {
        //$requestの情報を代入
        $data = $request->data;
        $id = $request->session()->get('id');
        $name = $request->session()->get('name');
        $work_id = $request->session()->get('work_id');
        $role = $request->session()->get('role');

        //管理者でログインしてるかを確認(アドレス直打ちでのブラウザ表示を拒否するため)
        if (empty($id) && empty($role)) {
            return redirect('login');
        } else {
            if ($role != 1) {
                return redirect('login');
            }
        }

        //DBと照合してデータ検索 ⇒ like検索であいまい検索(キーワードが含まれてればヒット、orでどちらか1つでも含まれたらヒット)
        //検索結果は同じbladeに表示するため、bladeで表示する為に変数名は上記のメソッドと同じに揃えないといけない、
        $users_list = DB::table('users')->where('work_id', 'like', "%$data%")->orWhere('name', 'like', "%$data%")->get();

        //検索結果をリダイレクト
        $view = view('admin', [
            'users_list' => $users_list, //検索結果データ
            'user_name' => $name, //ここから下3つはheader用に渡すデータ
            'user_role' => $role,
            'work_id' => $work_id,
        ]);
        return $view;   //空のとき & 検索にヒットしない場合もreturn $viewで一覧の中身は空表示となる
                        //return redirectは使用しない ⇒ そもそもredirectには$viewはセットできない
    }

}


