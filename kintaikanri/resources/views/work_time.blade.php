<!-- 宮内専用 -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KintaTourokugamenn</title>

    <!-- BootStrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/work_time.css') }}" rel="stylesheet">
    <link href="{{ asset('css/side.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    
</head>

<body>
    <div class="main_wrapper">
        @include('common.side', [ 'role' => $user_role ])

        <div class="main">
            @include('common.header', ['view_name' => '勤退登録画面' , 'user_name' => $user_name, 'work_id' => $work_id])

<!-- ↓↓ 長尾さん、宮内さんは ここから下から各自のコードを書き始めていただければ大丈夫です ↓↓ -->
        <div class="work_time">

            <div class="time_view" id="viewTime">
                <script type="text/javascript">
                    timer = setInterval('clock()',1000); //時刻の更新
                    function clock() {
                        document.getElementById("viewTime").innerHTML = getNow();  // ⇒ 現在時刻取得用メソッド
                        document.getElementById("date_now").value = getNowDate();  // ⇒ 送信用メソッド（<input type="hidden">で渡すよう）
                        document.getElementById("time_now").value = getNowTimestamp();  // ⇒ 送信用メソッド（<input type="hidden">で渡すよう）
                        
                    }
                    function getNow() {   // ⇒ 現在時刻取得用メソッド
                        var now = new Date();
                        var year = now.getFullYear();
                        var mon = (now.getMonth()+1).toString().padStart(2, '0'); //２桁表示
                        var day = now.getDate().toString().padStart(2, '0'); //２桁表示
                        var hour = now.getHours().toString().padStart(2, '0'); //２桁表示
                        var min = now.getMinutes().toString().padStart(2, '0'); //２桁表示
                        var sec = now.getSeconds().toString().padStart(2, '0'); //２桁表示
                        var you = now.getDay(); //曜日
                        //曜日の配列（日～土）
                        var youbi = new Array("日","月","火","水","木","金","土");
                        //出力用 
                        var s = year + "/" + mon + "/" + day + "(" + youbi[you] + ")<br>" + hour + ":" + min + ":" + sec ;
                        return s;
                    }
                    function getNowDate() {   // ⇒ 送信用メソッド
                        var now = new Date();
                        var year = now.getFullYear();
                        var mon = (now.getMonth()+1).toString().padStart(2, '0');
                        var day = now.getDate().toString().padStart(2, '0');
                        //出力用 
                        var s = year + "-" + mon + "-" + day;
                        return s;
                    }
                    function getNowTimestamp() {   // ⇒ 送信用メソッド
                        var now = new Date();
                        var hour = now.getHours().toString().padStart(2, '0');
                        var min = now.getMinutes().toString().padStart(2, '0');
                        var sec = now.getSeconds().toString().padStart(2, '0');
                        //出力用 
                        var s = hour + ":" + min + ":" + sec ;
                        return s;
                    }
                    window.onload = clock;  // ⇒ これにより、ブラウザに表示するのと同時に時刻も表示する事ができる
                </script>
            </div>

            <form action="{{ url('/insert') }}" method="post">
            @csrf
                <input type="hidden" name="date_now" id="date_now">  <!-- ← 年月も一緒にformで飛ばす用（上記でsprigタグで書いた送信用メソッドに紐づく） -->
                <input type="hidden" name="time_now" id="time_now">  <!-- ← 時刻も一緒にformで飛ばす用（上記でsprigタグで書いた送信用メソッドに紐づく） -->
                
                <div class="time_circle">
                    <div class="upclass">
                        <input id="radio1" class="syukkin" type="radio" name="situation" value="出勤">
                        <label class="syukkin" for="radio1">出勤</label>
                        <input id="radio2" class="taikin" type="radio" name="situation" value="退勤">
                        <label class="taikin" for="radio2">退勤</label>
                    </div>
                    <div class="downclass">
                        <input id="radio3" class="kyuukeiiri" type="radio" name="situation" value="休憩入り">
                        <label class="kyuukeiiri" for="radio3">休憩入り</label>
                        <input id="radio4" class="kyuukeimodori" type="radio" name="situation" value="休憩戻り">
                        <label class="kyuukeimodori" for="radio4">休憩戻り</label>
                    </div>
                </div>

                <div class="comment_box">
                    <input type="text" id="comment" name="comment" maxlength="30" placeholder="コメント" value="">
                </div>

                <button class="add_button" type="submit" name="submit">登録</button>
            </form>
            

<!-- ↓↓ 長尾さん、宮内さん、ここから下は触らないようにお願いします  ↓↓ -->
        </div>
    </div>

</body>

</html>