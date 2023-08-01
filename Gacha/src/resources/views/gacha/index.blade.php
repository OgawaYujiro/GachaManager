<html>
<head>
    <title>ガチャ</title>
</head>
<body>
    <h1>ガチャ画面</h1>

    @foreach($Wrap as $gacha)
        {{ $gacha }}
    @endforeach

    <div>
        <a href="/Gacha">ガチャを引く</a>
    </div>
    <div>
        <a href="/user">戻る</a>
    </div>

</body>
</html>