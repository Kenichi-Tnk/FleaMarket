@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('main')
    <div class="user-content">
        <div class="user-group">
            <img class="user-group__icon" src="{{ $img_url }}">
            <div class="user-unit">
                <p class="user-unit__name">{{ $user->name }}</p>
            </div>
        </div>
        <a class="user-content__profile" href="/mypage/profile">プロフィールを編集</a>
    </div>

    <div class="tab-content">
        <label class="tab-content__label">
            <input class="tab-content__input" type="radio" name="tab" value="sell_items" checked>出品した商品
        </label>
        <div class="tab-content__group">
            @foreach($sellItems as $item)
            <div>
                @if($item->soldToUsers()->exists())
                    <div class="sold-out__mark">SOLD OUT</div>
                @endif
                <a class="tab-content__content-link" href="/item/{{ $item->id }}">
                    <img class="tab-content__content-image" src="{{ $item->img_url }}">
                </a>
            </div>
            @endforeach

            @for($i = 0; $i < 10; $i++)
                <div class="tab-content__dummy"></div>
            @endfor
        </div>

            <label class="tab-content__label">
                <input class="tab-content__input" type="radio" value="bought_items" name="tab">購入した商品
            </label>
            <div class="tab-content__group">
                @foreach($soldItems as $item)
                    <div class="tab-content__content">
                        <div class="sold-out__mark">SOLD OUT</div>
                        <a class="tab-content__link" href="/item/{{ $item->id }}">
                            <img class="tab-content__image" src="{{ $item->img_url }}">
                        </a>
                    </div>
                @endforeach

                @for($i = 0; $i < 10; $i++)
                    <div class="tab-content__dummy"></div>
                @endfor
            </div>
    </div>
@endsection
