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
            <img class="image-group__image" src="{{ asset('storage/' . $item->img_url) }}" alt="商品画像">
        </div>
    </div>

    <div class="detail-content">
        <div class="item-group">
            <h2 class="item-group__title">{{$item->name}}</h2>
            <p class="item-group__price">￥{{ number_format($item->price) }}</p>
            <div class="item-unit">
                @if($userFavorited)
                    <form class="form-content" action="{{ route('favorites.destroy', ['item_id' => $item->id]) }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="item-icon__button" type="submit">
                            <img class="item-icon__image" src="{{ asset('storage/img/icons/star_red.svg') }}" alt="お気に入り">
                            <p class="favorites-count">{{ $favoritesCount }}</p>
                        </button>
                    </form>
                @else
                    <form action="{{ route('favorites.store', ['item_id' => $item->id]) }}" method="post">
                        @csrf
                        <button class="item-icon__button" type="submit">
                            <img class="itm-icon__image" src="{{ asset('storage/img/icons/star.svg') }}" alt="お気に入り">
                            <p class="favorites-count">{{ $favoritesCount }}</p>
                        </button>
                    </form>
                @endif
                <div class="comment-content">
                        <button class="item-icon__button" onclick="location.href='{{ $link }}'"></button>
                        <img class="item-icon__image"
                            src="{{ request()->is('item/comment/*') ? asset('storage/img/icons/comment.svg') : asset('storage/img/icons/comment_red.svg') }}" alt="コメント">
                        <p class="comments-count">{{ $commentsCount }}</p>
                </div>
            </div>
        </div>

        <div class="comment-group">
        @foreach ($comments as $comment)
            @if (Auth::id() === $comment['userId'])
                <div class="comment-content comment-content--right">
                    <div class="user-area user-area--right">
                        <span class="user-area__name">{{ $comment['userName' ]}}</span>
                        <img class="user-area__image" src="{{ $comment[ 'userIcon'] }}">
                    </div>
                    <div class="comment-area comment-area--right">
                        <p class="comment-area__text">{{ $comment['comment'] }}</p>
                    </div>
                </div>
            @else
                <div class="comment-content">
                    <div class="user-area">
                        <img class="user-area__image" src="{{ $comment['userIcon'] }}">
                        @if ($item->user_id === $comment['userId'])
                            <span class="user-area__name user-area__seller">出品者</span>
                        @else
                            <span class="user-area__name">{{ $comment['userName'] }}</span>
                        @endif
                    </div>
                    <div class="comment-area">
                        <p class="comment-area__text">{{ $comment['comment'] }}</p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <form class="form-group" id="comment-form" action="{{ route('comments.store', ['item_id' => $item->id]) }}" method="post">
        @csrf
        <label class="form-group__label">商品へのコメント
            <textarea class="form-group__textarea" name="comment" rows="5" required></textarea>
        </label>
        <button class="submit-button" type="submit" onclick="return confirm('コメントを送信しますか？')">コメントを送信する</button>
    </form>
        @yield('content')
    </div>
@endsection
