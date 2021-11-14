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
                            $week = [ "日", "月", "火", "水", "木", "金", "土" ];
                        ?>
                        @foreach( $work_times as $work_time )
                        <?php
                            //データを分解して代入
                            $date =  $work_time -> date;
                            $timestamp = strtotime ( $date );
                            $w_num = date('w', $timestamp);
                        ?>
                        <!-- 曜日の色分け（ 土曜:水色 , 日曜:ピンク ） -->
                        <?php if ($w_num == 0) { ?>                                         <!-- ↓↓ cssの「:hover」の役割 -->
                            <tr class="menu_top menu_pink" style="background-color:#FFDDFF" onMouseOut="this.style.background='#FFDDFF';" onMouseOver="this.style.background='rgba(250, 162, 235, 0.5)'">
                        <?php } else if ($w_num == 6) { ?>
                            <tr class="menu_top menu_blue" style="background-color:#DDFFFF" onMouseOut="this.style.background='#DDFFFF';" onMouseOver="this.style.background='rgba(63, 166, 235, 0.2)'">
                        <?php } else { ?>
                            <tr class="menu_top menu_nomal">
                        <?php } ?>
                            <!-- 各<td>の表示内容指定 -->
                            <td>{{$work_time -> date . "(" .$week[$w_num] . ")"}}</td>
                            <td>{{$work_time -> start_time}}</td>
                            <td>{{$work_time -> end_time}}</td>
                            <td>{{$work_time -> rest_on}}</td>
                            <td>{{$work_time -> rest_back}}</td>
                            <td class="comment_view">{{$work_time -> comment}}</td>
                            <td><button class="menu_button" onclick="submit_to_edit('{{ $date }}')">編集</button></td><!-- ボタンが押されたらJavaScriptのメソッドを呼び出す -->
                        </tr>
                        @endforeach
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

