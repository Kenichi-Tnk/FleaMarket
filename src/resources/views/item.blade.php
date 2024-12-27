@extends('layouts.item_detail')

@section('content')
    @if ($item->soldToUsers()->exists())
        <div class="link-button link-button--disabled">売り切れ</div>
    @elseif ($userItem)
        <a class="link-button link-button--blue" href="/sell/{{ $item->id }}">編集する</a>
    @else
        <a class="link-button" href="/purchase/{{ $item->id }}">購入手続きへ</a>
    @endif
    <div class="description-group">
        <h3 class="descriotion-group__title">商品説明</h3>
        <p class="description-group__text">{{ $item->description }}</p>
    </div>
    <div class="infomation-group">
        <h3 class="infomation-group__title">商品の情報</h3>
        <div class="infomation-content">
            <span class="infomation-content__title">カテゴリー</span>

        </div>
        <div class="infomation-content">
            <span class="infomation-content__title">商品の状態</span>
            <span class="infomation-content__text">{{ $condition }}</span>
        </div>
    </div>
@endsection
