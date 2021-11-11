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

<body>
    <div class="main_wrapper">
        @include('common.side', [ 'role' => $user_role ])

        <div class="main">
            @include('common.header', ['view_name' => '編集画面' , 'user_name' => $user_name, 'work_id' => $work_id])

<!-- ↓↓ 長尾さん、宮内さんは ここから下から各自のコードを書き始めていただければ大丈夫です ↓↓ -->
            <div class="edit">
                <form action="{{ url('update') }}" method="post">
                @csrf
                    <input class="display_date" type="text" name="date" id="date" value="{{ $record->date }}" readonly>
                    
                    <div class="upclass">
                        <div class="shainn">
                            <p class="title_name1">社員ID</p>
                            <input type="text" name="work_id" value="{{ $work_user->work_id }}" readonly>
                        </div>

                        <div class="simei">
                            <p class="title_name2">氏名</p>
                            <input type="text" name="name" value="{{ $work_user->name }}" readonly>
                        </div>
                    </div>
                    
                    <div class="downclass">
                        <div class="select_kinnmu">
                            <p class="title_name3">勤務状況</p>
                            <select name="kinmu">
                                <option value="出勤" selected>出勤</option>
                                <option value="退勤">退勤</option>
                                <option value="休憩入">休憩入</option>
                                <option value="休憩戻">休憩戻</option>
                            </select>
                        </div>

                        <div class="jikoku">
                            <p class="title_name4">時刻</p>
                            <div class="hour_minites">
                                <select name="hour">
                                    @for($i = 0; $i <=23; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>;
                                    @endfor 
                                </select>
                                <p class="sub_label">時</p>

                                <select name="minites" >
                                    @for($i = 0; $i <=59; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>;
                                    @endfor
                                </select>
                                <p class="sub_label">分</p>
                            </div>
                        </div>
                    </div>

                    <p class="title_name5">コメント</p>
                    <input class="comment_box" type="text" id="comment" name="comment" maxlength="30" placeholder="コメント" value="{{ $record->comment }}"><br>
                    <button class="save_button" type="submit" name="submit">保存</button>
                </form>
            </div>

<!-- ↓↓ 長尾さん、宮内さん、ここから下は触らないようにお願いします  ↓↓ -->
        </div>
    </div>

</body>

</html>