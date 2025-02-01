@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('main')
    @if(session('success'))
        <div class="message-success" id="message">
            {{ session('success') }}
            <script src="https:ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    $("#message").fadeIn(1000).delay(3000).fadeOut(1000);
                });
            </script>
        </div>
    @endif

    <div class="image-content">
        <div class="image-group">
            <img class="image-group__image" src="{{ asset('storage/' . $item->img_url) }}" alt="商品画像">
        </div>
    </div>

    <div class="detail-content">
        <div class="item-group">
            <h2 class="item-group__title">{{$item->name}}</h2>
            <p class="item-group__price">￥{{ number_format($item->price) }}</p>
            <div class="item-unit">
                @if($userFavorited)
                    <form class="form-content" action="/item/unfavorite/{{ $item->id }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="item-icon__button" type="submit">
                            <img class="item-icon__image" src="{{ asset('storage/img/icons/star_red.svg') }}" alt="お気に入り">
                            <p class="favorites-count">{{ $favoritesCount }}</p>
                        </button>
                    </form>
                @else
                    <form action="/item/favorite/{{ $item->id }}" method="post">
                        @csrf
                        <button class="item-icon__button" type="submit">
                            <img class="itm-icon__image" src="{{ asset('storage/img/icons/star.svg') }}" alt="お気に入り">
                            <p class="favorites-count">{{ $favoritesCount }}</p>
                        </button>
                    </form>
                @endif
                <div class="comment-content">
                    <button class="item-icon__button" onclick="location.href='{{ $link }}'">
                        <img class="item-icon__image"
                        src="{{ request()->is('item/comment/*') ? asset('storage/img/icons/comment_red.svg')
                        : asset('storage/img/icons/comment.svg') }}" alt="コメント">
                        <p class="comments-count">{{ $commentsCount }}</p>
                    </button>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
@endsection
