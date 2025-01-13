<?php
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('main')
@section('main')
<div class="payment-container">
    <div class="payment-form">
        <div class="form-group">
            <label for="cardNumber">カード番号</label>
            <input type="text" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456">
        </div>
        <div class="form-group">
            <label for="expiryDate">有効期限</label>
            <div class="expiry-date">
                <select class="select-limit" name="month">
                    <option hidden>月</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <select class="select-limit" name="year">
                    <option hidden>年</option>
                    @for ($i = 2023; $i < 2043; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="cardName">カードに記載された名前</label>
            <input type="text" id="cardName" name="cardName" placeholder="TARO YAMADA">
        </div>
        <button type="button" class="btn-add-card">追加</button>
    </div>

    @foreach($payments as $payment)
        <div class="radio-list">
            <label class="payment-label">
                <input class="payment-radio" type="radio" name="payment" value="{{ $payment->id }}">{{ $payment->method }}
            </label>
        </div>
    @endforeach
</div>
@endsection
