@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('main')
    <h1 class="main-title">プロフィール設定</h1>
    <form class="form-content h-adr" action="/mypage/profile/update" method="post" enctype="multipart/formdata">
        @csrf
        <div class="image-group">
            <img class="image-group__icon" id="preview-image" src="{{ $user->image_url }}">
            <label class="image-group__label">
                <input class="image-group__input" type="file" name="file" id="image" onchange="previewFile()">画像を選択する</input>
            </label>
        </div>

        <label class="form-content__label">ユーザー名
            <input class="form-content__input" type="text" name="name" value="{{ $user->name }}">
        </label>
        @error('name')
            <div class="form-content__error">{{ $message }}</div>
        @enderror

        <span class="p-country-name" style="display: none;">Japan</span>
        <label class="form-content__label">郵便番号
            <input class="form-content__input p-postal-code" type="text" size="8" maxlenght="8" name="postcode" value="{{ $profile->postcode ?? '' }}">
        </label>
        @error('postcode')
            <div class="form-content__error">{{ $message }}</div>
        @enderror

        <label class="form-content__label">住所
            <input class="form-content__input p-region p-locality p-street-address" type="text" name="address" value="{{ $profile->address ?? '' }}">
        </label>
        @error('')
            <div class="form-content__error">{{ $message }}</div>
        @enderror

        <label class="form-content__label">建物名
            <input class="form-content__input" type="text" name="building" value="{{ $profile->building ?? '' }}">
        </label>
        <button class="form-content__button" type="submit" onclick="return confirm('プロフィールを更新しますか？')">更新する</button>
    </form>
@endsection
