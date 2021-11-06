
<!-- 柳田専用 -->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kannrisyagaamenn</title>

    <!-- BootStrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/side.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
</head>

<body>
    <div class="main_wrapper">
        @include('common.side' , [ 'role' => $user_role ])

        <div class="main">
            @include('common.header' , [ 'view_name' => '管理者画面' , 'user_name' => $user_name, 'work_id' => $work_id] )

            <div class="users_list">
                <h1>社員一覧</h1>

                <form action="{{ url('search')}}" method="post">
                    @csrf
                    <button class="btn btn-secondary" type="submit">検索</button>
                    <input type="text" name="data" id="data" placeholder="社員ID or 氏名...">
                </form>

                <table class="list">
                    <thead class="list_title">
                        <tr >
                            <!-- <th scope="col" class="no" >番号</th> -->
                            <th scope="col" class="work_id">社員ID</th>
                            <th scope="col" class="name">氏名</th>
                        </tr>
                    </thead>
                    <tbody class="list_result">
                        @foreach($users_list as $user)
                            <tr>
                                <!-- <th scope="row" class="no">{{ $user->id }}</th> -->
                                <td class="work_id">{{ $user->work_id }}</td>
                                <td class="name"><a href="{{ url('monthly_list/'. $user->work_id) }}">{{ $user->name }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>

