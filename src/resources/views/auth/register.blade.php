@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('main')
    <h2 class="main-title">会員登録</h2>
    <form class="form-content" action="{{ route('register') }}" method="post">
        @csrf
        <label class="form-content__label">ユーザー名
            <input class="form-content__input" type="name" name="name" value="{{ old('name') }}">
        </label>
        @error('name')
            <div class="form-content__error">{{ $message }}</div>
        @enderror
        <label class="form-content__label">メールアドレス
            <input class="form-content__input" type="email" name="email" value="{{ old('email') }}">
        </label>
        @error('email')
            <div class="form-content__error">{{ $message }}</div>
        @enderror

        <label class="form-content__label">パスワード
            <input class="form-content__input" type="password" name="password">
        </label>
        @error('password')
            <div class="form-content__error">{{ $message }}</div>
        @enderror

        <label class="form-content__label">確認用パスワード
            <input class="form-content__input" type="password" name="password_confirmation">
        </label>

        <button class="form-content__button" type="submit">会員登録する</button>
        <a class="form-content__link" href="/login">ログインはこちら</a>
    </form>
@endsection
