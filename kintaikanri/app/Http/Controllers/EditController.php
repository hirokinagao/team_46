<?php

// 宮内専用

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Facades\DB;


class EditController extends Controller
{
    /**
     * 
     * 編集画面表示用テストメソッド（ ⇒ 長尾さんのpost_editメソッドが完成した為、不要になったメソッド）
     * 
     */
    // public function edit(Request $request)
    // {
    //     //$requestの情報を代入
    //     $id = $request->session()->get('id');
    //     $name = $request->session()->get('name');
    //     $role = $request->session()->get('role');
    //     $work_id = $request->session()->get('work_id');
    //
    //     $view = view('edit', [
    //         'user_name' => $name,   //ここから下3つはheader用に渡すデータ(各画面共通)
    //         'user_role' => $role,
    //         'work_id' => $work_id,
    //     ]);
    //     return $view;
    // }



    /**
     * 会員編集機能(保存ボタン押下後)
     * 
     * @param Request $request
     * @return Response
     */

    //一般ユーザーが自分の編集をする時
    // public function update(Request $request)
    // {
    //     return $this->update_id($request, $request->session()->get('work_id'));
    // }

    //管理者が編集する時
    //public function update_id(Request $request,string $work_id)
    
    //一般ユーザー・管理者ユーザー問わず同じメソッドで
    public function update(Request $request)
    {
        //$requestの情報を代入
        $login_work_id = $request->session()->get('work_id'); //編集する人
        $work_id = $request->work_id; //編集される人
        $date = $request->date;
        $time = $request->hour . ':' . $request->minites .':00';
        //プルダウン判別
        $situation = $request->kinmu;
        if ($situation == '出勤') {
            $situation = 'start_time';
        } else if ($situation == '退勤') {
            $situation = 'end_time';
        } else if ($situation == '休憩入') {
            $situation = 'rest_on';
        } else if ($situation == '休憩戻') {
            $situation = 'rest_back';
        }
        //コメントを上書きしないための処理（ ← 編集の場合は勤退登録時と逆で、コメントを消したい場合は「''」で上書きできないとダメなので、このif分の処理はコメントアウトし、上書き内容のみを代入）
        $vars = [];
        // if($request->comment == ''){
        //     $vars = [
        //         $situation => $time,
        //         'updated_id' => $login_work_id  //更新者のwork_id
        //     ];
        // } else {
            $vars = [
                $situation => $time,
                'comment' => $request->comment,
                'updated_id' => $login_work_id  //更新者のwork_id
            ];
        // }

        //DBのデータを更新
        DB::table('work_times')->where('user_id', $work_id)->where('date', $date)->update($vars);

        // return redirect('/monthly_list');
            // ↑↑ これだと編集ボタン押下後に、編集される人のページではなくログインした人(管理者自身のページ)に遷移してしまうので ↓↓ 下のコードを採用する
        list($year, $month, $day) = preg_split('/-/', $date);  // $dateは「年-月-日」のデータなので、「-」で区切ってそれぞれに分ける
        return redirect('/monthly_list/'.$work_id.'/'.$year.'-'.$month);  // 「編集される人のwork_id」と、上で分けた「年」と「月」を引数に持たせてmonthly_list.bladeを呼び出すことで、編集される人の指定の月の月別一覧画面へ遷移できる
    }

}
