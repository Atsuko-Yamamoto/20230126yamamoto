<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atte</title>
  <link rel="stylesheet" href="/css/reset.css">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header class="header">
  <h1 class="header_left">Atte</h1>
  <nav>
    <ul class="header_right">
      <li class="header_list">
        <a href="{{ route('rest.index') }}" class="list_link">ホーム</a>
      </li>
      <li class="header_list">
        <a href="{{ route('rest.attendance') }}" class="list_link">日付一覧</a>
      </li>
      <li class="header_list">
        <a href="{{ route('logout') }}" class="list_link">ログアウト</a>
    </li>
    </ul>
  </nav>
</header>
<main>

  <form action="{{ route('rest.attendance') }}" method="post">
  @csrf
  <div class="bn_date">
    <button name="back" class="bn_switch">
    <
  </button>
  {{$show_date}}
  <button name="next" class="bn_switch">
    >
  </button>
  </div>
  </form>
  <table class="attend_table">
    <tbody>
    <tr class="attend_tr">
      <th>名前</th>
      <th>勤務開始</th>
      <th>勤務終了</th>
      <th>休憩時間</th>
      <th>勤務時間</th>
    </tr>
    @foreach ($attendances as $attendance)
    <tr class="attend_tr">
      <td>
      {{$attendance->user->name}}
      </td>
      <td>
        {{$attendance->start_time}}
      </td>
      <td>
        {{$attendance->end_time}}
      </td>
      <td>
        {{$rests_total[$attendance->id]}}
      </td>
      <td>
        {{$attendances_total[$attendance->id]}}
      </td>
    </tr>
    @endforeach
  </tbody>
  </table>
  <div class="paginate">
  {!! $attendances->links() !!}
  </div>
</main>
<footer>
  Atte,inc.
</footer>
</body>