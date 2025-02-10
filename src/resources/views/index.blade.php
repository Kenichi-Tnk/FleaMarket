@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('main')
    <div class="tab-content">
        <label class="tab-content__label recommendation__label">
            <input class="tab-content__input" type="radio" name="tab" checked>おすすめ
        </label>
        <div class="tab-content__group">
            @foreach($items as $item)
                <div class="tab-content__content">
                    @if ($item->soldToUsers()->exists())
                        <div class="sold-out__mark">SOLD OUT</div>
                    @endif
                    <a class="tab-content__content-link" href="/item/{{ $item->id }}">
                        <img class="tab-content__content-image" src="{{ 'storage/' . $item->img_url }}">
                    </a>
                    <div class="tab-content__content-title">{{ $item->name }}</div>
                </div>
            @endforeach
            @for ($i = 0; $i < 10; $i++)
                <div class="tab-content__content dummy"></div>
            @endfor
        </div>

        <label class="tab-content__label">
            <input class="tab-content__input" type="radio" name="tab">マイリスト
        </label>
        @if (Auth::check())
            <div class="tab-content__group">
                @forelse ($favoriteItems as $favoriteItem)
                    <div class="tab-content__content">
                        @if ($favoriteItem->soldToUsers()->exists())
                            <div class="sold-out__mark">SOLD OUT</div>
                        @endif
                        <a class="tab-content__content-link" href="/item/{{ $favoriteItem->id }}">
                            <img class="tab-content__content-image" src="{{ asset('storage/' . $favoriteItem->img_url) }}">
                            <div class="tab-content__content-title">{{ $favoriteItem->name }}</div>
                        </a>
                    </div>
                @empty
                    <p class="no-message">マイリストはありません</p>
                @endforelse

                @for ($i = 0; $i < 10; $i++)
                    <div class="tab-content__content dummy"></div>
                @endfor
            </div>
        @else
            <div class="tab-content__group-link">
                <a class="link-button" href="/register">会員登録</a>
                <span class="tab-content__group-text">及び</span>
                <a class="link-button" href="/login">ログイン</a>
                <span class="tab-content__group-text">が必要です。</span>
            </div>
        @endif
    </div>
@endsection
