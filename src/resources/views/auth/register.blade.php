<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
</head>
<body>
<h1>会員登録</h1>

<form action="/register" method="POST">
    @csrf

        <div>
        <label for="name">名前</label>
        <input type="text" name="name" id="name">
    </div>

    <div>
        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email">
    </div>

    <div>
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password">
    </div>

    <div>
        <label for="password_confirmation">確認用パスワード</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
    </div>

<button type="submit">登録する</button>


<a href="/login">ログインはこちら</a>

</form>
</body>
</html>