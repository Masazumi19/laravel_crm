<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit</title>
</head>

<body>
    <h1>顧客情報編集</h1>

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

    <form action="/customers/{{ $customer->id }}" method="post">
        @csrf
        @method('PATCH')
        <p><label for="name">名前</label>
            <input type="text" name="name" id="name" value={{ old('name', $customer->name) }}>
        </p>
        <p>
            <label for="email">メールアドレス</label>
            <input type="text" name="email" id="email" value={{ old('email', $customer->email) }}>
        </p>

        <p>
            <label for="postcode">郵便番号</label>
            <input type="text" name="postcode" id="postcode" value={{ old('postcode', $customer->postcode) }}>
        </p>

        <p>
            <label for="address">住所</label>
            <input type="text" name="address" id="address" value={{ old('address', $customer->address) }}>
        </p>
        <p>
            <label for="phonenumber">電話番号</label>
            <input type="text" name="phonenumber" id="phonenumber" value={{ old('phonenumber', $customer->phonenumber) }}>
        </p>

        <input type="submit" value="更新">
    </form>
