<?php

// 宮内専用

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Facades\DB;

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

        // ☆ idがなかった場合(ログインしたかのチェック) ⇒ アドレス直打ちでのブラウザ表示を拒否するため
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
     * 勤退登録機能(登録ボタン押下後に月別一覧画面表示)
     * 
     * @param Request $request
     * @return Response
     */
    public function insert(Request $request)
    {
        //$requestの情報を代入
        $work_id = $request->session()->get('work_id');
        $situation = $request->situation;
        $today_record = DB::table('work_times')->where('user_id', $work_id)->where('date', $request->date_now)->first();
        //ラジオボタン判別
        if ($situation == '出勤') {
            $situation = 'start_time';
        } else if ($situation == '退勤') {
            $situation = 'end_time';
        } else if ($situation == '休憩入り') {
            $situation = 'rest_on';
        } else if ($situation == '休憩戻り') {
            $situation = 'rest_back';
        }
        //登録時の判別(最初の登録はinsert、それ以降の登録はupdate)
        if (empty($today_record)) {
            // 登録(最初のみ)
            DB::table('work_times') -> insert([
                'user_id' => $work_id,
                'date' => $request->date_now,
                $situation => $request->time_now,
                'comment' => $request->comment,
                'updated_id' => $work_id  //更新者(登録者)のwork_id
            ]);
        } else {
            //コメントを上書きしないための処理
            $comment = $request->comment;
            if($comment == ''){
                $comment = $today_record->comment;
            }
            // 更新(それ以降)
            DB::table('work_times')->where('user_id', $work_id)->where('date', $request->date_now)->update([
                'user_id' => $work_id,
                'date' => $request->date_now,
                $situation => $request->time_now,
                'comment' => $comment,
                'updated_id' => $work_id  //更新者(登録者)のwork_id
            ]);
        }

        return redirect('/monthly_list');

        //今回の場合は1つのカラムに何度も登録する為、上記のように条件分岐の処理が必要。よって ↓↓ 以下のシンプルな処理では登録処理ができない×
        // DB::table('work_times')->insert([
        //     'date' => $request->time_now,
        //     'start_time' => $request->start_time,
        //     'end_time' => $request->end_time,
        //     'rest_on' => $request->rest_on,
        //     'rest_back' => $request->rest_back,
        //     'comment' => $request->comment
        // ]);
        //return redirect('/monthly_list');
    }

}
