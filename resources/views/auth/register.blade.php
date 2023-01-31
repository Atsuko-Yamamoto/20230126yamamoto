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
    <h1>会員登録</h1>
    </div>
    <div class="form_container">
    <table>
        <form action="{{ route('register') }}" method="POST">
        <tr>
            <td>
            @csrf
                <input type="text" name="name" placeholder="名前" class="form_box">   
            </td>
        </tr>
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
                <input type="password" name="password_confirmation" placeholder="確認用パスワード" class="form_box">   
            </td>
        </tr>
        <tr>
            <td>
                <button type="submit" class="bn_add">会員登録</button>
            </td>
        </tr>
        </form>
        <tr>
            <td class="login">
            <p>アカウントをお持ちの方はこちらから</p>
            <a href="{{ route('login') }}" class="login_link">ログイン</a>
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