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

            <span id="viewTime"></span>
            <script type="text/javascript">
                timer = setInterval('clock()',1000); //時刻の更新
                function clock() {
                    document.getElementById("viewTime").innerHTML = getNow();
                }
                function getNow() {
                    var now = new Date();
                    var year = now.getFullYear();
                    var mon = now.getMonth()+1; //１を足すこと
                    var day = now.getDate();
                    var hour = now.getHours();
                    var min = now.getMinutes();
                    var sec = now.getSeconds();
                    var you = now.getDay(); //曜日
                    //曜日の配列（日～土）
                    var youbi = new Array("日","月","火","水","木","金","土");
                    //出力用 
                    var s = year + "年" + mon + "月" + day + "日 (" + youbi[you] + ")<br>" + hour + "時" + min + "分" + sec + "秒" ;
                    return s;
                }
                window.onload = clock;
            </script>

            <br>

            <div class="syukkin">
                <span>出勤</span>
            </div>

            <div class="taikin">
                <span>退勤</span>
            </div>

            <br>

            <div class="kyuukeiiri">
                <span>休憩入り</span>
            </div>

            <div class="kyuukeimodori">
                <span>休憩戻り</span>
            </div>

            <input type="text" id="comment" name="comment" size="80" style="width:535;border:1px solid #00ccff">
            <form action="index.php" method="post">
                <button type="submit" name="add">登録</button>
            </form>
        
<!-- ↓↓ 長尾さん、宮内さん、ここから下は触らないようにお願いします  ↓↓ -->
        </div>
    </div>

</body>

</html>