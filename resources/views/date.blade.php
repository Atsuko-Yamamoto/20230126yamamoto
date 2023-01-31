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
      <li class="header_list">日付一覧</li>
      <li class="header_list">
        <a href="{{ route('logout') }}" class="list_link">ログアウト</a>
    </li>
    </ul>
  </nav>
</header>
<footer>
  Atte,inc.
</footer>
</body>