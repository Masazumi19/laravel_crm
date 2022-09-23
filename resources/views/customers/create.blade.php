<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>



<body>
    

    @if ($errors->any())
        <div class="error">
            <p>
                <b>{{ count($errors) }}件のエラーがあります。</b>
            </p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>新規登録画面</h1>
    <form action="{{ route('customers.store') }}" method="post">
    @csrf
        <p>
            <label for="name">名前</label>
            <input type="string" name="name" id="name" value="{{ old('name') }}">
        </p>

        <p>
            <label for="email">メールアドレス</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}">
        </p>

        <p>
            <label for="postcode">郵便番号</label>
            <input type="string" name="postcode" id="postcode" value="{{ old('postcode') }}">
        </p>
        <p>
            <label for="address">住所</label>
            <textarea type="text" name="address" id="address">{{ $address }}</textarea>
        </p>
        <p>
            <label for="phonenumber">電話番号</label>
            <input type="string" name="phonenumber" id="phonenumber" value="{{ old('phonenumber') }}">
        </p>

        <input type="submit" value="登録">
    </form>
    <button tyepe="button" onclick="location.href='/postcode'">郵便番号検索に戻る</button>
</body>

</html>
