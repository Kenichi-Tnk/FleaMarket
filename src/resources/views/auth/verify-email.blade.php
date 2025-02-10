@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('メールアドレスをご確認ください') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('ご登録頂いたメールアドレスに確認用のリンクを送信しました。') }}</br>
                    {{ __('もし確認用メールが送信されていない場合は、下記をクリックしてください') }}
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('確認用メールを再送信する') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection