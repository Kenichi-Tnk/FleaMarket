@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('main')
    @if (session('success'))
        <div class="message-success" id="message">
            {{ session('success') }}
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const message = document.getElementById('message');
                message.style.display = 'block';
                setTimeout(function() {
                    message.style.display = 'none';
                }, 4000);
            });
        </script>
    @endif

    <div class="section-container">
        <div class="section-group">
            <div class="image-content">
                <img class="image-content__image" src="{{ asset('storage/' . $item->img_url) }}" alt="商品画像">
            </div>
            <div class="item-content">
                <h2 class="item-content__title">{{ $item->name }}</h2>
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
                        @foreach($user->userPayments as $payment)
                            <option value="{{ $payment->id }}">{{ $payment->method }}</option>
                        @endforeach
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
            <diV class="address-content">
                @if($profile)
                    <p class="address-content__text">〒{{ substr($profile->postcode, 0, 3) . '_' . substr($profile->postcode, 3) }}</p>
                    <p class="address-content__text">{{ $profile->address }}<span>{{ $profile->building }}</span></p>
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
        <input type="hidden" name="payment_id" value="{{ $paymentId }}">
        <button class="submit-button" type="submit" onclick="return confirm('購入しますか？')">購入する</button>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#paymentSelect').on('click', function() {
            $(this).toggleClass('open');
            });
        });
    </script>
@endsection
