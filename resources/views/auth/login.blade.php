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
</header>
<main>
    <div class="user">
    <h1>ログイン</h1>
    </div>
    <div class="form_container">
    <table class="login_table">
        <form action="{{ route('login') }}" method="post">
            @csrf
        <tr>
            <td>
                <input type="email" name="email" placeholder="メールアドレス" class="form_box">   
            </td>
        </tr>
            <tr>
            <td>
                <input type="password" name="password" placeholder="パスワード" class="form_box">   
            </td>
        </tr>
        <tr>
            <td>
                <button type="submit" class="bn_add">ログイン</button>
            </td>
        </tr>
        </form>
        <tr>
            <td class="login">
            <p>アカウントをお持ちでない方はこちらから</p>
            <a href="{{ route('register') }}" class="login_link">会員登録</a>
            </td>
        </tr>
    </table>
</div>
</main>
<footer>
    Atte,inc.
</footer>
</body>
</html>