@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('main')
<h2 class="main-title">ログイン</h2>
<form class="form-content" action="/login" method="post">
    @csrf
    <label class="form-content__label">ユーザー名/メールアドレス
        <input class="form-content__input" type="email" name="email" value="{{ old('email') }}">
    </label>
    @error('email')
        {{ $message }}
    @enderror

    <label class="form-content__label">パスワード
        <input class="form-content__input" type="password" name="password">
    </label>
    @error('password')
        {{ $message }}
    @enderror

    <button class="form-content__button" type="submit">ログインする</button>
    <a class="form-content__link" href="/register">会員登録はこちら</a>
</form>
@endsection
