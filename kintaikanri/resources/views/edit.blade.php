<!-- 宮内専用 -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hensyuugamenn</title>

    <!-- BootStrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
    <link href="{{ asset('css/side.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    
</head>

<body class="home">
    <div class="container">
        @include('common.side')

        <div class="main">
            <div class="main-header">
                @include('common.header')
            </div>

<!-- ↓↓ 長尾さん、宮内さんは ここから下から各自のコードを書き始めていただければ大丈夫です ↓↓ -->
            <div class="edit">
            <p>社員ID</p> <p>氏名</p><br>

            <p>勤務状況</p> <select name="kinmu">
                <option value="出勤">出勤</option>
                <option value="退勤">退勤</option>
                <option value="休憩入">休憩入</option>
                <option value="休憩戻">休憩戻</option>
            </select>
            <p>時刻</p>
            <select name="hour"></select>
            
            <p>時</p>
            <select name="minites" id=""></select>
            <p>分</p>
            <p>コメント</p>
            input type="text" id="comment" name="comment" size="80" style="width:535;border:1px solid #00ccff">
            <form action="index.php" method="post">
            <button type="submit" name="add">保存</button>
            </div>

<!-- ↓↓ 長尾さん、宮内さん、ここから下は触らないようにお願いします  ↓↓ -->
        </div>
    </div>

</body>

</html>