@exdends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('main')
    @if(session('success'))
        <div class="message-success" id="message">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="main-title">商品の出品</h2>
    <form class="form-content" action="{{ isset($item_id) ? '/sell/' . $item_id: '/sell/' }}" method="post" enctype="multipart/form-data">
        @csrf
        <span class="form-content__label">商品の画像
            @if($item)
                <a class="image-link" href="{{ $item->img_url}}">
                    <img class="preview-image" id="preview-image" src="{{ $item->img_url }}">
                </a>
            @else
                <img class="preview-image" id="preview-image" style="display: none;">
            @endif
            <div class="image-group">
                <label class="image-group__label">
                    <input class="image-group__input" type="file" id="image" name="img_url" onchange="previewFile()">画像を選択する
                </label>
            </div>
        </span>
        @error('img_url')
            <div class="form-content__error">{{ $message }}</div>
        @enderror

        <h3 class="form-content__title">商品の詳細</h3>
        <label class="form-content__label">カテゴリー
            <select class="form-content__select" name="category_id">
                <option disabled {{ collect($selectCategories)->every('selected',false) ? 'selected' : '' }}>--- 選択してください ---</option>
                @foreach($selectCategories as $category)
                    <option value="{{ $category['id'] }}" {{ $category['selected'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                @endforeach
            </select>
        </label>
        @error
            <div class="form-conten__error">{{ $message }}</div>
        @enderror

        <label class="form-content__title">商品の状態
            <select></select>
        </label>
    </form>
@endsection
