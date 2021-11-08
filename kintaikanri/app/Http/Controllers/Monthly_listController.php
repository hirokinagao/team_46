<?php

// 長尾専用

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Monthly_listController extends Controller
{
    /**
     * 月別一覧画面表示
     *
     * @param Request $request ⇒ここの$requestはsessionのデータ
     * @return Response
     */
    public function monthly_list(Request $request)
    {
        //$requestの情報を代入
        $id = $request->session()->get('id');
        $name = $request->session()->get('name');
        $role = $request->session()->get('role');
        $work_id = $request->session()->get('work_id');

        //☆idがなかった場合(ログインしたかのチェック) ⇒ アドレス直打ちでのブラウザ表示を拒否するため
        if(empty($id)){
            return redirect('login');
        }

        //DBと照合してデータ検索
        $users = DB::table('work_times')->where('user_id',$work_id)->get();

        $view = view('monthly_list', [
            'users' => $users,      //上記でDBから取得したデータ
            'user_name' => $name,   //ここから下3つはheader用に渡すデータ(各画面共通)
            'user_role' => $role,
            'work_id' => $work_id,
        ]);
        return $view;
    }


    /**
     * 管理者ページから月別一覧画面を表示する用
     *
     * @param Request $request
     * @return Response
     */
    public function monthly_id(Request $request,string $work_id)
    {
        //$requestの情報を代入
        $id = $request->session()->get('id');
        $name = $request->session()->get('name');
        $role = $request->session()->get('role');
        // $work_id = $request->session()->get('work_id');

        //☆idがなかった場合(ログインしたかのチェック) ⇒ アドレス直打ちでのブラウザ表示を拒否するため
        if(empty($id)){
            return redirect('login');
        }

        //DBと照合してデータ検索
        //$users = DB::table('work_times')->get();
        $users = DB::table('work_times')->where('user_id',$work_id)->get();

        $view = view('monthly_list', [
            'users' => $users,      //上記でDBから取得したデータ
            'user_name' => $name,   //ここから下3つはheader用に渡すデータ(各画面共通)
            'user_role' => $role,
            'work_id' => $work_id,
        ]);
        return $view;
    }




}



