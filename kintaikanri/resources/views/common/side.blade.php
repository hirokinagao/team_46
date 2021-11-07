
<!-- 柳田専用 -->

<div class="side">
    <ul class="nav flex-column">
        <li class="nav-item"><img src="./img/logo.png" alt="ロゴ画像"></li>
        <li class="nav-item"><a href="{{ url('monthly_list') }}" class="nav-link icon tukibetu">月別一覧</a></li>
        <li class="nav-item"><a href="{{ url('work_time') }}" class="nav-link icon">勤退登録</a></li>
        @if ( $user_role == 1 )
            <li class="nav-item">
                <a href="{{ url('admin') }}" class="nav-link icon">管理者画面</a>
            </li>
        @endif
        <li class="nav-item"><a href="{{ url('/')}}" class="btn btn-primary logout">ログアウト</a></li>
    </ul>
</div>