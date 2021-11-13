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
     *      (下のmonthly_idメソッドとmonthly_id_dateが完成したため、必要な情報のみを残してｺﾒﾝﾄｱｳﾄし、必要な情報を引数として下のメソッドに渡す)
     *      ( monthly_list , monthly_id , monthly_id_date の３つのメソッド ⇒ 最終的にmonthly_id_dateメソッドに繋がるが、渡す引数がそれぞれ違う為、動作が異なる)
     *              ↓↓
     *        ( monthly_listは、引数がログインした人の work_id と「''」のdate )
     *        ( monthly_idは、引数が管理者画面で指定した人の work_id と「''」のdate ) 
     *        ( monthly_id_dateは引数に上のどちらかが渡されて、同じ処理をするメソッド ※dateに関して「''」の時とそれ以外で動作を分ける処理もしている ) 
     *
     * @param Request $request ⇒ここの$requestはsessionのデータ、login時の送信データ
     * @return Response
     */
    //「セッション情報」と「ログインした人のwork_id」と「''空のデータ」を最終的に下の「monthly_id_dateメソッド」に渡す
    public function monthly_list(Request $request)
    {
        //$requestの情報を代入
        // $id = $request->session()->get('id');
        // $name = $request->session()->get('name');
        // $role = $request->session()->get('role');
        $work_id = $request->session()->get('work_id');  //ログインした人のwork_id

        //☆idがなかった場合(ログインしたかのチェック) ⇒ アドレス直打ちでのブラウザ表示を拒否するため
        // if(empty($id)){
        //     return redirect('login');
        // }

        // //DBと照合してデータ検索
        // $work_times = DB::table('work_times')->where('user_id',$work_id)->get();
        // $user = DB::table('users')->where('work_id',$work_id)->first();   // ⇒ 月別一覧の上に、一覧表示する対象の「社員IDと社員氏名」を表示する用

        // $view = view('monthly_list', [
        //     'work_times' => $work_times,    //上記でDBから取得したデータ
        //     'work_user' => $user,           //上記でDBから取得したデータ
        //     'user_name' => $name,   //ここから下3つはheader用に渡すデータ(各画面共通)
        //     'user_role' => $role,
        //     'work_id' => $work_id,
        // ]);
        // return $view;

        return $this->monthly_id($request,$work_id); //「セッション情報」と「ログインした人のwork_id」と「''空のデータ」をmonthly_idを利用して最終的に下の「monthly_id_dateメソッド」に渡す（monthly_idを利用するのは「''」空のデータを渡すため）
    }





    /**
     * 管理者ページから月別一覧画面を表示する用
     *      (一般ユーザーの場合にも、このメソッドを使用する為、上のmonthly_listメソッドの被ってる内容はｺﾒﾝﾄｱｳﾄし、必要な引数だけを、このmonthly_idメソッドに渡している)
     *
     * @param Request $request  ⇒ここの$requestはsessionのデータ
     * @return Response
     */
    //「セッション情報」と「リンクから飛んだwork_id」と「''空のデータ」を下の「monthly_id_dateメソッド」に渡す
    public function monthly_id(Request $request,string $work_id)  // ⇒ Routeでセットした「/monthly_list/{id}」の「{id}」に当たるのが$work_id(管理者画面で指定した人の work_id)
    {
        return $this->monthly_id_date($request,$work_id,'');  // $this：このclassのって意味、「''」空のデータを渡すことでリアルタイムの年月を下のメソッドで「''」へ代入できる
    }

    //上の2つのどちらかのメソッドから渡された、「セッション情報」と「work_id」と「リアルタイムを代入する用の「''」空のデータを使い、メソッドを動かし画面遷移
    public function monthly_id_date(Request $request,string $work_id,string $date)  // ⇒ monthly_listメソッド or monthly_idメソッド のどちらかの引数と「''」空のdateを引数としてmonthly_id_dateメソッドを動かす
    {
        //$requestの情報を代入
        $id = $request->session()->get('id');
        $name = $request->session()->get('name');
        $role = $request->session()->get('role');
        $login_work_id = $request->session()->get('work_id');

        // ☆ idがなかった場合(ログインしたかのチェック) ⇒ アドレス直打ちでのブラウザ表示を拒否するため
        if(empty($id)){
            return redirect('login');
        }

        //上のメソッドで「''」空のデータを受け取ったから、そこに表示させたいリアルタイムの年月のデータを代入する
        if (empty($date)) {
            $date = date('Y-m');
        }
        $yyyy = explode("-", $date)[0]; //リアルタイムの今年
        $mm = explode("-", $date)[1]; //リアルタイムの今月
        $fromDD = date('Y-m-d', mktime(0, 0, 0, $mm, 1, $yyyy)); //今月の1日
        $toDD = date('Y-m-d', mktime(0, 0, 0, $mm + 1, 0, $yyyy)); //今月の末日( = 次の月の0日)
        
        //DBと照合してデータ検索
        $work_times = DB::table('work_times')->where('user_id',$work_id)->whereBetween('date', [$fromDD, $toDD])->get(); // ⇒ dateのカラムの[$fromDD, $toDD]までに期間を取ってくる
        $user = DB::table('users')->where('work_id',$work_id)->first();   // ⇒ 月別一覧の上に、一覧表示する対象の「社員IDと社員氏名」を表示する用

        $view = view('monthly_list', [
            'work_times' => $work_times,      //上記でDBから取得したデータ
            'work_user' => $user,             //上記でDBから取得したデータ
            'user_name' => $name,   //ここから下3つはheader用に渡すデータ(各画面共通)
            'user_role' => $role,
            'work_id' => $login_work_id,
        ]);
        return $view;
    }


    /**
     * 月別一覧画面機能（編集ボタン押下後）
     *
     * @param Request $request  ⇒ここの$requestはsessionのデータと$_POSTのデータ
     * @return Response
     */
    public function post_edit(Request $request)
    {
        //$requestの情報を代入
        $id = $request->session()->get('id');
        $name = $request->session()->get('name');
        $role = $request->session()->get('role');
        $login_work_id = $request->session()->get('work_id');

        // ☆ idがなかった場合(ログインしたかのチェック) ⇒ アドレス直打ちでのブラウザ表示を拒否するため
        if(empty($id)){
            return redirect('login');
        }

        //$requestの情報を代入
        $date = $request->date;
        $work_id = $request->work_id;

        //DBと照合してデータ検索
        $record = DB::table('work_times')->where('user_id',$work_id)->where('date',$date)->first();   // ⇒ $_POSTで渡されたdateから、該当のdateのデータを１行とってくる
        $work_user = DB::table('users')->where('work_id',$work_id)->first();   // ⇒ 月別一覧の上に、一覧表示する対象の「社員IDと社員氏名」を表示する用

        $view = view('edit', [
            'record' => $record,         //上記でDBから取得したデータ
            'work_user' => $work_user,   //上記でDBから取得したデータ
            'user_name' => $name,   //ここから下3つはheader用に渡すデータ(各画面共通)
            'user_role' => $role,
            'work_id' => $login_work_id,
        ]);
        return $view;
    }

}



