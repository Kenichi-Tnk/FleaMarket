@extends('layouts.item_detail')

@section('content')
    @if ($item->soldToUsers()->exists())
        <div class="link-button link-button--disabled">売り切れ</div>
    @elseif ($userItem)
        <a class="link-button link-button--blue" href="/sell/{{ $item->id }}">編集する</a>
    @else
        <a class="link-button" href="/purchase/{{ $item->id }}">購入手続きへ</a>
    @endif
    <div class="description-group">
        <h3 class="description-group__title">商品説明</h3>
        <p class="description-group__text">{{ $item->description }}</p>
    </div>
    <div class="information-group">
        <h3 class="information-group__title">商品の情報</h3>
        <div class="information-content">
            <span class="information-content__title">カテゴリー</span>
            <span class="information-content__text">{{ $item->categories->pluck('content')->join(', ') }}</span>
        </div>
        <div class="information-content">
            <span class="information-content__title">商品の状態</span>
            <span class="information-content__text">{{ $condition }}</span>
        </div>
    </div>

    <div id="comment-section">
        <div class="comment-group">
            @foreach ($comments as $comment)
                @if (Auth::id() === $comment['userId'])
                    <div class="comment-content comment-content--right">
                        <div class="user-area user-area--right">
                            <span class="user-area__name">{{ $comment['userName' ]}}</span>
                            <img class="user-area__image" src="{{ asset('storage/' . $comment['userIcon']) }}">
                        </div>
                        <div class="comment-area comment-area--right">
                            <p class="comment-area__text">{{ $comment['comment'] }}</p>
                        </div>
                    </div>
                @else
                    <div class="comment-content">
                        <div class="user-area">
                            <img class="user-area__image" src="{{ asset('storage/' . $comment['userIcon']) }}">
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

        <form class="form-group" action="/item/comment/store/{{ $item->id }}" method="post">
            @csrf
            <label class="form-group__label">商品へのコメント
                <textarea class="form-group__textarea" name="comment" rows="5" required></textarea>
            </label>
            <button class="submit-button" type="submit" onclick="return confirm('コメントを送信しますか？')">コメントを送信する</button>
        </form>
    </div>
@endsection
