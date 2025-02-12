@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('main')
    @if (session('success'))
        <div class="message-success" id="message">
            {{ session('success') }}
        </div>
        <script src="https:ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#message").fadeIn(1000).delay(3000).fadeOut(1000);
            });
        </script>
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
            <form action="{{route('purchase.selectPayment', ['item_id' => $item->id]) }}" method="post">
                    @csrf
                    <select name="payment" class="payment-select">
                        @foreach($payments as $payment)
                            <option value="{{ $payment->id }}" {{ session('paymentId') == $payment->id ? 'selected' : '' }}>{{ $payment->method }}</option>
                        @endforeach
                    </select>
                    <button class="link-button" type="submit">変更する</button>
                </form>
                @error('payment_id')
                    <p class="payment-content__text payment-content__text-error">{{ $errors->first('payment_id') }}</p>
                @enderror
        </div>
        <div class="address-group">
            <div class="header-content">
                <h3 class="header-content__title">配送先</h3>
                <a class="link-button" href="/purchase/address/{{ $item->id }}">変更する</a>
            </div>
            <div class="address-content">
                    <p class="address-content__text">〒{{ substr($user->postcode, 0, 3) . '-' . substr($user->postcode, 3) }}</p>
                    <p class="address-content__text">{{ $user->address }}<span>{{ $user->building }}</span></p>
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
