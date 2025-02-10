@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('main')
    @if (session('success'))
        <div class="message-success" id="message">
            {{ session('success') }}
        </div>
    @endif

    <div class="section-container">
        <div class="section-group">
            <div class="image-content">
                <img class="image-content__image" src="{{ asset('storage/' . $item->img_url) }}" alt="商品画像">
            </div>
            <div class="item-content">
                <h1 class="item-content__title">{{ $item->name }}</h1>
                <p class="item-content__price">￥{{ number_format($item->price) }}</p>
            </div>
        </div>
        <div class="payment-group">
            <div class="header-content">
                <h3 class="header-content__title">支払い方法</h3>
            </div>
            <div class="payment-content">
                <form id="paymentForm" action="/purchase/payment/select/{{ $item->id }}" method="post">
                    @csrf
                    <select name="payment" id="paymentSelect" required>
                        <option value="">選択してください</option>
                        <option value="カード支払い" {{ $paymentMethod === 'カード支払い' ? 'selected' : '' }}>カード支払い</option>
                        <option value="コンビニ支払い" {{ $paymentMethod === 'コンビニ支払い' ? 'selected' : '' }}>コンビニ支払い</option>
                    </select>
                    <button type="submit">変更する</button>
                </form>
            </div>
        </div>
        <div class="address-group">
            <div class="header-content">
                <h3 class="header-content__title">配送先</h3>
                <a class="link-button" href="/purchase/address/{{ $item->id }}">変更する</a>
            </div>
            <div class="address-content">
                @if($user->address)
                    <p class="address-content__text">〒{{ substr($user->postcode, 0, 3) . '-' . substr($user->postcode, 3) }}</p>
                    <p class="address-content__text">{{ $user->address }}<span>{{ $user->building }}</span></p>
                @else
                    <p class="address-content__text">プロフィールが設定されていません</p>
                @endif
            </div>
        </div>
    </div>
    <form class="confirm-container" action="/purchase/decide/{{ $item->id }}" method="post">
        @csrf
        <div class="confirm-group">
            <div class="confirm-content confirm-content__price">
                <p class="confirm-content__title">商品代金</p>
                <p class="confirm-content__text">￥{{ number_format($item->price) }}</p>
            </div>
            <div class="confirm-content confirm-content__total">
                <p class="confirm-content__title">支払い金額</p>
                <p class="confirm-content__text">￥{{ number_format($item->price) }}</p>
            </div>
            <div class="confirm-content confirm-content__payment">
                <p class="confirm-content__title">支払い方法</p>
                <p class="confirm-content__text">{{ $paymentMethod ?? '' }}</p>
            </div>
        </div>
        <input type="hidden" name="payment_id" value="{{ $paymentId ?? '' }}">
        <button class="submit-button" type="submit" onclick="return confirm('購入しますか？')">購入する</button>
    </form>
@endsection
