<html>
<head>
  <title>ログイン画面</title>
</head>
<body>
<h1>ログイン画面</h1>
  @error('login')
  <p>{{ $message }}</p>
  @enderror

  <form method="POST" action="/login">
    @csrf
    <label>名前</label>
    <input type="name" name="name"><br>
    <label>パスワード</label>
    <input type="password" name="password"><br>
    <button type="submit">ログイン</button>
  </form>

</body>
</html>