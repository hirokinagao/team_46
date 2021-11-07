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
            <p>社員ID&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;氏名</p>
            <input type="text" name="ID" value="<?php if(!empty ($_POST['work_id']) ){echo $_POST['work_id'];}  ?>"disabble>&emsp;&emsp;&emsp;<input type="text" name="name" value="<?php if(!empty ($_POST['name']) ){echo $_POST['name'];}  ?>"disabble><br>
            勤務状況&emsp;&emsp;&emsp;時刻<br>
            <select name="kinmu">
                <option value="出勤">出勤</option>
                <option value="退勤">退勤</option>
                <option value="休憩入">休憩入</option>
                <option value="休憩戻">休憩戻</option>
            </select>
            &emsp;&emsp;
            <select name="hour">
            <?php
            for($i = 0; $i <=23; $i++)
                print('<option value="' . $i . '">' . $i . '</option>');
            ?>   
            </select>時
            <select name="minites" >
            <?php
            for($i = 0; $i <=59; $i++)
                print('<option value="' . $i . '">' . $i . '</option>');
            ?> 
            </select>分<br>
            コメント<br>
            <textarea id="coment" name="coment" cols="30" rows="3" maxlength="30"></textarea>
            <form action="index.php" method="post">
            <button type="submit" name="add">保存</button>
            </div>

<!-- ↓↓ 長尾さん、宮内さん、ここから下は触らないようにお願いします  ↓↓ -->
        </div>
    </div>

</body>

</html>