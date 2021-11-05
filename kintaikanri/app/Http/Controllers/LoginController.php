<?php

// 柳田専用

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;  
        // ⇒ Log::errorを使用するためにセット

class LoginController extends Controller
{
    /**
     * ログイン画面表示
     * 
     * @return Response
     */
    public function login()
    {
        return view ('login');
    }


    /**
     * ログイン機能 ⇒ ログイン成功→セッションへデータを保存する→月別一覧画面表示
     * 
     * @param Request $request ⇒ここの$requestはsessionのデータ
     * @return Response
     */
    public function session(Request $request)
    {
        //$requestの情報を代入
        $work_id = $request->work_id;
        $password = $request->password;

        //DBと照合してwork_idが一致するデータを探す
        $userdata = DB::table('users')->where('work_id', $work_id)->first();
        // ユーザーが存在しない or work_id が違う場合エラーメッセージを返しlogin画面に戻す
        if(empty($userdata)){
            $error_message = '社員番号が違います。';
            $view = view('login', [
                'message' => $error_message,
            ]);
            return $view;
        }
        //「laravel.log」に出力させるためのコード（ここに出力させる事で入力された内容が確認ができる）
        Log::error($work_id);
        Log::error($password);
        Log::error($userdata->password);

        //ログイン機能（パスワード(ハッシュ値のpassword)チェックをする）
        if (!password_verify($password, $userdata->password)) {
            //パスワード不一致の場合 or 入力がない場合 はエラーメッセージを返しlogin画面に戻す
            $error_message = 'パスワードが違います。';
            $view = view('login', [
                'message' => $error_message,
            ]);
            return $view;
        }

        //DBから取ってきたデータをセッションに保存
        $request->session()->put('id', $userdata->id);
        $request->session()->put('name', $userdata->name);
        $request->session()->put('work_id', $userdata->work_id);
        $request->session()->put('role',  $userdata->role);

        //monthly_list.bladeを呼び出す( (仮)コード：本来は長尾さんがコントローラーのメソッドに書く内容を(仮)で作成してる)
        $view = view('monthly_list', [
            'user_data' => $userdata,
            'user_name' => $userdata->name,
            'user_role' => $userdata->role,
            'work_id' => $userdata->work_id,
        ]);
        return $view;

        //return redirect('monthly_list');  //(仮)コードが必要なくなったら、こちらのコードと差し替える
                                            //redirect：https://qiita.com/sola-msr/items/4f92686d474118d1cceb
    }
}


