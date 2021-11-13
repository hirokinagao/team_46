
<!-- 柳田専用 -->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- BootStrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>

<body>
    <div class="login-wrapper">
        <div class="container">
            <img src="./img/logo.png" alt="ロゴ画像">
            <form action="{{ url('login_session')}}" method="post">
                @csrf
                @if(isset($message))
                    <p class="message">{{$message}}</p>
                @endif
                <input type="text" name="work_id" id="work_id" placeholder="社員ID" maxlength="10" required autofocus><br>
                <input type="password" name="password" id="password" placeholder="password" maxlength="20" required><br>
                <button class="btn login" type="submit">login</button>
            </form>
        </div>
    </div>
</body>

</html>

