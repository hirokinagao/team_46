<!-- 長尾専用 -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TukibetuItiran</title>
    <!-- BootStrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/monthly_list.css') }}" rel="stylesheet">
    <link href="{{ asset('css/side.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
</head>

<body>
    <div class="main_wrapper">
        @include('common.side', [ 'role' => $user_role ])
        <div class="main">
                @include('common.header', ['view_name' => '月別一覧画面' , 'user_name' => $user_name, 'work_id' => $work_id])
<!-- ↓↓ 長尾さん、宮内さんは ここから下から各自のコードを書き始めていただければ大丈夫です ↓↓ -->
            <div class="area">
                <div class="area_item">                                                     <!--  ↓↓ ここのvalueに指定の月が入る（最初はリアルタイムの年月が入るように設定してある）  -->
                    <input onchange="changeCal()" type="month" name="upload_url" id="upload_url" value="{{ $work_month }}" >
                            <!-- ↑ onchange は「値が変わったら」という意味、ここでは「値（value）が変わったら = カレンダーが選択されたら」changeCalメソッドを呼び出している -->
                </div>
                <script>
                    //カレンダーを選択したら、URLの末尾に「/ 一覧表示対象者のwork_id / 上記の<input>の「onchange」で指定された年-月」を加えて、それを呼び出すメソッド
                    function changeCal(){
                        window.location.href = '/monthly_list/{{ $work_user->work_id }}/' + document.getElementById('upload_url').value;
                    }
                </script>
                <div class="display_view">
                    <p class="display_in"><span>{{ $work_user->work_id }}</span><span>{{ $work_user->name }}</span></p>
                </div>
                <h1>月別一覧</h1>
            </div>
            <div class="table">
                <table border="1">
                    <tr class="memu" style="background-color:rgba(235, 235, 235, 0.8)">
                        <th class="memu_item">日付</th>
                        <th>出勤</th>
                        <th>退勤</th>
                        <th>休憩入り</th>
                        <th>休憩戻り</th>
                        <th>コメント</th>
                        <th>編集</th>
                    </tr>
                    <form action="{{ url('post_edit') }}"method="post" name="dateform">
                    @csrf
                        <?php
                            // 今月の最初の日（11/1）のタイムスタンプを取得
                            $start_of_month = mktime(0, 0, 0, $month, 1, $year);   // mktime関数：指定した日時のタイムスタンプを取得するためのメソッド、引数は第1引数から順番に時間、分、秒、月、日、年、https://techacademy.jp/magazine/39497
                            // 今月の最後の日（11/30）のタイムスタンプを取得  // 末日( = 次の月の0日)
                            $end_of_month = mktime(0, 0, 0, $month + 1, 0, $year);
                            
                            $week = [ "日", "月", "火", "水", "木", "金", "土" ];
                        ?>
                        <?php
                            $j = 0;   //( $work_times as $work_time の $work_timeにあたるのが $j )
                            // var_dump($work_times);
                            for ($i = 1; $i <= date('d', $end_of_month); $i++) {   // 1に+1ずつしていく( 11/1～$end_of_monthまで(11/30まで) )
                                $date = mktime(0, 0, 0, $month, $i, $year);     // $year(controllerから渡された値),$month(controllerから渡された値),$i(1～末日)のタイムスタンプを取得
                                $w_num = date('w',$date);     // $year,$month,$i(1～末日)のタイムスタンプから曜日を取得(date関数の「w」：数字 0(日曜) から 6(土曜))
                                                               //date関数は指定された日時を任意の形式（今回は('w')）でフォーマットし、日付文字列を返す関数  https://techacademy.jp/magazine/36439 , https://www.sejuku.net/blog/21821
                                                                //       ↓↓
                                                                // 第一引数にフォーマット文字列を指定
                                                                // 第二引数を省略した場合は、現在日時が第一引数で指定した形式でフォーマットされる
                                                                // 第二引数にUNIXタイムスタンプを指定した場合は、そのUNIXタイムスタンプがフォーマットされる
                                                                // UNIXタイムスタンプとは、1970年1月1日からの秒数
                                
                                $work_timestamp = 0;    // $jがある時のタイムスタンプを取得する ⇒ もし今月の一月分のデータ空じゃなかったら && $work_timesが$j以上( ＝もう表示するものがないかどうか＝まだ{}内の処理をできるものが残っているかどうか)だったら、{}内の処理 ⇒ $work_timesのjのデータからdateを１日ずつ値を持ってきて$work_timestampに代入(タイムスタンプ取得)
                                if ( !$work_times->isEmpty() && $j < count($work_times) ) {  // $work_times(controllerから渡された値)  // isEmpty , count：https://www.delftstack.com/ja/howto/php/how-to-check-whether-an-array-is-empty-in-php/
                                    $work_timestamp = strtotime( $work_times[$j]->date );    //strtotime関数：指定した日時のUNIXタイムスタンプを取得する  https://www.sejuku.net/blog/21821
                                }
                        ?>
                                <!-- 曜日の色分け（ 土曜:水色 , 日曜:ピンク ） -->
                                <?php if ($w_num == 0) { ?>                                         <!-- ↓↓ cssの「:hover」の役割 -->
                                    <tr class="menu_top menu_pink" style="background-color:#FFDDFF" onMouseOut="this.style.background='#FFDDFF';" onMouseOver="this.style.background='rgba(250, 162, 235, 0.5)'">
                                <?php } else if ($w_num == 6) { ?>
                                    <tr class="menu_top menu_blue" style="background-color:#DDFFFF" onMouseOut="this.style.background='#DDFFFF';" onMouseOver="this.style.background='rgba(63, 166, 235, 0.2)'">
                                <?php } else { ?>
                                    <tr class="menu_top menu_nomal">
                                <?php } ?>
                                <!-- 各<td>の表示内容指定-->
                                <?php if ( $work_timestamp != $date ) { ?>  <!-- データが空だった時の処理 -->
                                    <td class="date_view">                  <!-- $work_timestamp：$work_timesのjのデータからdateを１日ずつ値を持ってきて作成されたタイムスタンプ , $date：今月の１～末日のタイムスタンプ -->
                                        <?php
                                            echo date('Y-m-d', $date).'(';
                                            echo $week[ date('w', $date) ];
                                            echo ')'
                                        ?>
                                    </td>
                                    <td class="time_view"></td>
                                    <td class="time_view"></td>
                                    <td class="time_view"></td>
                                    <td class="time_view"></td>
                                    <td class="comment_view"></td>
                                    <td><button class="menu_button" onclick="submit_to_edit('{{ date('Y-m-d', $date) }}')">編集</button></td><!-- ボタンが押されたらJavaScriptのメソッドを呼び出す -->
                                <?php } else { ?>                           <!-- データが空じゃない時の処理 -->
                                    <td class="date_view">{{$work_times[$j] -> date . "(" .$week[$w_num] . ")"}}</td>
                                    @if ($work_times[$j] -> start_time == '' && $work_times[$j] -> end_time != '')
                                        <td class="time_view" style="background-color: #FFFF33;"><div class="tooltip1">ｘ<div class="description1">開始時間を入力してください</div></div></td> <!-- substr関数：start_timeが空じゃなかったら、秒を省いて表示（ 0 から（先頭から）、後ろから３文字目を切る（つまり先頭から4文字目までの文字 ））、「：」⇒「else」空を表示する -->
                                    @else
                                        <td class="time_view">{{$work_times[$j] -> start_time != '' ? substr($work_times[$j] -> start_time , 0, -3) : '' }}</td> <!-- substr関数：start_timeが空じゃなかったら、秒を省いて表示（ 0 から（先頭から）、後ろから３文字目を切る（つまり先頭から4文字目までの文字 ））、「：」⇒「else」空を表示する -->
                                    @endif
                                    @if ($work_times[$j] -> end_time == '' && $work_times[$j] -> start_time != '')
                                        <td class="time_view" style="background-color: #FFFF33;'"><div class="tooltip1">ｘ<div class="description1">終了時間を入力してください</div></div></td>
                                    @else
                                        <td class="time_view">{{$work_times[$j] -> end_time != '' ? substr($work_times[$j] -> end_time , 0, -3) : '' }}</td>
                                    @endif
                                    <?php
                                        $rest_err = false;
                                        $rest_err_msg = '';
                                        if ( $work_times[$j] -> start_time != '' && $work_times[$j] -> end_time != '') {
                                            $s_hour = substr($work_times[$j] -> start_time, 0, 2);
                                            $s_min = substr($work_times[$j] -> start_time, 3, 2);
                                            $s_sec = substr($work_times[$j] -> start_time, 6, 2);
                                            $s_time = mktime($s_hour, $s_min, $s_sec, $month, $i, $year);  //秒数がでる
                                            $e_hour = substr($work_times[$j] -> end_time, 0, 2);
                                            $e_min = substr($work_times[$j] -> end_time, 3, 2);
                                            $e_sec = substr($work_times[$j] -> end_time, 6, 2);
                                            $e_time = mktime($e_hour, $e_min, $e_sec, $month, $i, $year);
                                            // 8時間以上で１時間以上の休憩
                                            if ( ($e_time - $s_time)/3600 >= 8) {   //差分をとる  /3600で時間にする
                                                if ($work_times[$j] -> rest_on != '' && $work_times[$j] -> rest_back != '') {  //休憩時間の入りと戻りの差分
                                                    $rs_hour = substr($work_times[$j] -> rest_on, 0, 2);
                                                    $rs_min = substr($work_times[$j] -> rest_on, 3, 2);
                                                    $rs_sec = substr($work_times[$j] -> rest_on, 6, 2);
                                                    $rs_time = mktime($rs_hour, $rs_min, 0, $month, $i, $year);
                                                    $re_hour = substr($work_times[$j] -> rest_back, 0, 2);
                                                    $re_min = substr($work_times[$j] -> rest_back, 3, 2);
                                                    $re_sec = substr($work_times[$j] -> rest_back, 6, 2);
                                                    $re_time = mktime($re_hour, $re_min, 0, $month, $i, $year);
                                                    if ( ($re_time - $rs_time)/3600 < 1) {
                                                        $rest_err = true;
                                                        $rest_err_msg = '休憩時間が１時間未満です';
                                                    }
                                                } else {
                                                    $rest_err = true;
                                                    $rest_err_msg = '休憩時間が未入力です';
                                                }
                                            }
                                        }
                                    ?>
                                    @if ($rest_err)
                                        <td class="time_view" style="background-color:#FFFF33;'"><div class="tooltip1">{{$work_times[$j] -> rest_on != '' ? substr($work_times[$j] -> rest_on , 0, -3) : 'ｘ' }}<div class="description1">{{ $rest_err_msg }}</div></div></td>
                                    @else
                                        <td class="time_view">{{$work_times[$j] -> rest_on != '' ? substr($work_times[$j] -> rest_on , 0, -3) : '' }}</td>
                                    @endif
                                    @if ($rest_err)
                                        <td class="time_view" style="background-color:#FFFF33;'"><div class="tooltip1">{{$work_times[$j] -> rest_back != '' ? substr($work_times[$j] -> rest_back , 0, -3) : 'ｘ' }}<div class="description1">{{ $rest_err_msg }}</div></div></td>
                                    @else
                                        <td class="time_view">{{$work_times[$j] -> rest_back != '' ? substr($work_times[$j] -> rest_back , 0, -3) : '' }}</td>
                                    @endif
                                        <td class="comment_view">{{$work_times[$j] -> comment}}</td>
                                        <td><button class="menu_button" onclick="submit_to_edit('{{ date('Y-m-d', $date) }}')">編集</button></td><!-- ボタンが押されたらJavaScriptのメソッドを呼び出す -->
                                <?php 
                                    $j++;    //これをデータがあるだけ繰り返す
                                } ?>
                            </tr>
                        <?php
                            } // for文の終わり
                        ?>
                        <!-- EditControllerに必要な上記で足りないデータをhiddenで渡す -->
                        <input type="hidden" id="date" name="date">
                        <input type="hidden" id="work_id" name="work_id" value="{{ $work_user->work_id }}">
                    </form>
                    <script>
                        //編集ボタン押下時に作動するメソッド
                        function submit_to_edit(date){
                            document.getElementById('date').value = date;
                            document.dateform.submit();
                        }
                    </script>
                </table>
            </div>
        </div>
        <!-- ↓↓ 長尾さん、宮内さん、ここから下は触らないようにお願いします  ↓↓ -->
    </div>
</body>
</html>
