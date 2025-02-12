@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('main')
    <h2 class="main-title">住所の変更</h2>
    <form class="form-content h-adr" action="/purchase/address/update/{{$item_id}}" method="post">
        @csrf
        <span class="p-country-name" style="display: none">Japan</span>
        <label class="form-content__label" for="postcode">郵便番号
            <input class="form-content__input p-postcode" type="text" size="8" maxlength="8" id="postcode" name="postcode" value="{{ $profile->postcode ?? '' }}">
        </label>
        @error('postal-code')
            <div class="form-content__error">{{ $message }}</div>
        @enderror

        <label class="form-content__label" for="address">住所
            <input class="form-content__input p-region p-locality p-street-address p-extended-address" type="text" id="address" name="address" value="{{ $profile->address ?? '' }}">
        </label>
        @error('address')
            <div class="form-content__error">{{ $message }}</div>
        @enderror

        <label class="form-content__label" for="building">建物名
            <input class="form-content__input" type="text" id="building" name="building" value="{{ $profile->building ?? '' }}">
        </label>

        <button class="form-content__button" type="submit">更新する</button>
    </form>
@endsection