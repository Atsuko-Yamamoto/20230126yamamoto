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
<div class="user">
<h1>{{$user->name}}さんお疲れ様です！</h1>
</div>
  <form action="{{ route('rest.store') }}" method="post">
    @csrf
  <div class="container">
  <button class="box" name="work_start" @if($btn_state[0]==0) disabled @endif>勤務開始</button>
  <button class="box" name="work_end"   @if($btn_state[1]==0) disabled @endif>勤務終了</button>
  </div>
  <div class="container">
  <button class="box" name="rest_start" @if($btn_state[2]==0) disabled @endif>休憩開始</button>
  <button class="box" name="rest_end"   @if($btn_state[3]==0) disabled @endif>休憩終了</button>
  </div>
  </form>
  <div>
  </div>
</main>
<footer>
  Atte,inc.
</footer>
</body>
</html>