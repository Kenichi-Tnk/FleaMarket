@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('main')
    @if(session('success'))
        <div class="message-success" id="message">
            {{ session('success') }}
        </div>
    @endif

    <div class="image-content">
        <div class="image-group">
            <img class="image-group__image" src="{{ $item->img_url }}" alt="商品画像">
        </div>
    </div>

    <div class="detail-content">
        <div class="item-group">
            <h2 class="item-group__title">{{$item->name}}</h2>
            <span class="item-group__brand">{{$item->brand}}</span>
            <p class="item-group__price">￥{{$item->price}}</p>
            <div class="item-unit">
                @if($userFavorited)
                    <form class="form-content" action="/item/unfavorite/{{ $item->id }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="item-icon__button" type="submit">
                            <img class="item-icon__image" src="{{ asset('storage/img/star_red.svg') }}" alt="お気に入り">
                            <p class="favorites-count">{{ $favoritesCount }}</p>
                        </button>
                    </form>
                @else
                    <form action="/item/favorite/{{ $item->id }}" method="post">
                        @csrf
                        <button class="item-icon__button" type="submit">
                            <img class="itm-icon__image" src="{{ asset('storage/img/star.svg') }}" alt="お気に入り">
                            <p class="favorites-count">{{ $favoritesCount }}</p>
                        </button>
                    </form>
                @endif
                <div class="comment-content">
                    <button class="item-icon__button" onclick="location.href='{{ $link }}'">
                        <img class="item-icon__image" src="{{ request()->is('item/comment/*')  ? asset('storage/img/comment_red.svg') : asset('storage/img/comment.svg') }}" alt="コメント">
                        <p class="comments-count">{{ $commentsCount}}</p>
                    </button>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
@endsection
