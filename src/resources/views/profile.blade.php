@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('main')
    @if (session('success'))
        <div class="message-success" id="message">
            {{ session('success') }}
        </div>
        <script src="https:ajax.googleapis.com/ajax/libs/jquery/3.5.1/query.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#message").fadeIn(1000).delay(3000).(fadOut(1000));
            });
        </script>
    @endif
    <h1 class="main-title">プロフィール設定</h1>
    <script src="https://yubinbamgo.github.io/yubinbango.js" charset="UTF-8"></script>
    <form class="form-content h-adr" action="/mypage/profile/update" method="post" enctype="multipart/formdata">
        @csrf
        <div class="image-group">
            <img class="image-group__icon" src="{{ asset($user->image_url) }}" alt="ユーザーアイコン">
            <label class="image-group__label">
                <input class="image-group__input" type="file" name="image" id="image" onchange="previewFile()">画像を選択する
            </label>
            <script>
                function previewFile() {
                    const preview = document.querySelector('.image-group__icon');
                    const file = document.querySelector('input[type=file]').files[0];
                    const reader = new FileReader();

                    reader.addEventListener('load', function() {
                        preview.src = reader.result;
                    }, false);

                    if (file) {
                        reader.readAsDataURL(file);
                    }
                }
            </script>
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
