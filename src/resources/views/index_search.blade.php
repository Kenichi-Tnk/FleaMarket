@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('main')
    <div class="tab-content">
        <label class="tab-content__label">
            <input class="tab-content__input" type="radio" name="tab" checked>検索結果
        </label>
        <div class="tab-content__group">
            @forelse ($items as $item)
                <div class="tab-content__content">
                    <a class="tab-content__content-link" href="/item/{{ $item->id }}">
                        <img class="tab-content__content-image" src="{{ $item->img_url }}">
                    </a>
                </div>
                @empty
                <p class="no-message">該当するアイテムはありません</p>
            @endforelse

            @for ($i = 0; $i < 10; $i++)
                <div class="tab-content__content dummy"></div>
            @endfor
        </div>
    </div>
@endsection
