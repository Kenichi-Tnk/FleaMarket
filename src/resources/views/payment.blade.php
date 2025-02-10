<?php
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('main')
<div class="payment-container">
    <form action="{{ route('purchase.selectPayment', ['item_id' => $item_id]) }}" method="post">
        @csrf
        @foreach($payments as $payment)
            <div class="radio-list">
                <label class="payment-label">
                    <input class="payment-radio" type="radio" name="payment" value="{{ $payment->id }}">{{ $payment->method }}
                </label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">支払い方法を選択</button>
    </form>

    <form action="{{ route('purchase.decide', ['item_id' => $item_id]) }}" method="post">
        @csrf
        <input type="hidden" name="payment_id" value="{{ session('paymentId') }}">
        <button type="submit" class="btn btn-primary">購入する</button>
    </form>
</div>
@endsection
