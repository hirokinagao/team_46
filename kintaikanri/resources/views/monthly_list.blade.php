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

                <div class="display_view">
                    <p class="display_in"><span>{{ $work_user->work_id }}</span><span>{{ $work_user->name }}</span></p>
                </div>

                <h1>月別一覧</h1>
            </div>

            <div class="table">
                <table border="1">
                    <tr class="memu">
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
                            $week = array( "日", "月", "火", "水", "木", "金", "土" );
                        ?>
                        @foreach( $work_times as $work_time )
                        <?php
                            $date =  $work_time -> date;
                            $timestamp = strtotime ( $date );
                        ?>
                        <tr class="memu_top">
                            <td>{{$work_time -> date . "(" .$week[date('w', $timestamp)] . ")"}}</td>
                            <td>{{$work_time -> start_time}}</td>
                            <td>{{$work_time -> end_time}}</td>
                            <td>{{$work_time -> rest_on}}</td>
                            <td>{{$work_time -> rest_back}}</td>
                            <td class="comment_view">{{$work_time -> comment}}</td>
                            <td><button onclick="submit_to_edit('{{ $date }}')">編集</button></td>
                        </tr>
                        @endforeach
                        <input type="hidden" id="date" name="date">
                        <input type="hidden" id="work_id" name="work_id" value="{{ $work_user->work_id }}">
                    </form>

                    <script>
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

