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
                <div class="area_item">
                    <input onchange="onclick" type="month" name="">
                    <button>PDF</button>
                </div>
                <h1>月別一覧</h1>
            </div>
            <div class="table">
            <table border="1">
                <tr class="mene">
                    <th class="mene_item">日付</th>
                    <th>出勤</th>
                    <th>退勤</th>
                    <th>休憩</th>
                    <th>コメント</th>
                    <th>編集</th>
                </tr>

                @if(count($users) !== 0)
                    <form action="edit" method="post">
                    @csrf
                        @foreach($users as $user)
                        <tr class="mene_top">
                            <th>{{$user->date}}</th>
                            <th>{{$user->start_time}}</th>
                            <th>{{$user->end_time}}</th>
                            <th>{{$user->rest_on}}</th>
                            <th>{{$user->comment}}</th>
                            <th><button type="submit">編集</button></th>
                        </tr>
                        @endforeach
                    </form>
                @endif

            </table>
            </div>
        </div>
        <!-- ↓↓ 長尾さん、宮内さん、ここから下は触らないようにお願いします  ↓↓ -->
    </div>

</body>

</html>
