<?php

// 宮内専用

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Work_timeController extends Controller
{
    /**
     * 勤退登録画面表示
     * 
     * @param Request $request ⇒ここの$requestはsessionのデータ
     * @return Response
     */
    public function work_time(Request $request)
    {
        //$requestの情報を代入
        $id = $request->session()->get('id');
        $name = $request->session()->get('name');
        $role = $request->session()->get('role');
        $work_id = $request->session()->get('work_id');

        //☆idがなかった場合(ログインしたかのチェック) ⇒　アドレス直打ちでのブラウザ表示を拒否するため
        if(empty($id)){
            return redirect('login');
        }
        
        $view = view('work_time', [
            'user_name' => $name,   //ここから下3つはheader用に渡すデータ(各画面共通)
            'user_role' => $role,
            'work_id' => $work_id,
        ]);
        return $view;
    }


    /**
     * 勤退登録機能
     * 
     * @param Request $request 
     * @return Response
     */
    // public function メソッド名(Request $request)
    // {

    // }





}
