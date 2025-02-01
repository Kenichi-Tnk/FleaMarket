@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('main')
<h2 class="main-title">ログイン</h2>
<form class="form-content" action="{{ route('login') }}" method="post">
    @csrf
    <label class="form-content__label">ユーザー名/メールアドレス
        <input class="form-content__input" type="email" name="email" value="{{ old('email') }}">
    </label>
    @error('email')
        <div class="form-content__error">{{ $message }}</diV>
    @enderror

    <label class="form-content__label">パスワード
        <input class="form-content__input" type="password" name="password">
    </label>
    @error('password')
        <div class="form-content__error">{{ $message }}</diV>
    @enderror

    <button class="form-content__button" type="submit">ログインする</button>
    <a class="form-content__link" href="/register">会員登録はこちら</a>
</form>

@if (session('resent'))
    <div class="alert alert->success mt-3" role="alert">
        {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
@endif

@endsection
