@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('main')
    @if(session('success'))
        <div class="message-success" id="message">
            {{ session('success') }}
        </div>
        <script>
            $(document).ready(function(){
                $("#message").fadeIn(1000).delay(3000).fadeOut(1000);
            });
        </script>
    @endif

    <h2 class="main-title">商品の出品</h2>
    <form class="form-content" action="{{ isset($item_id) ? '/sell/' . $item_id: '/sell/' }}" method="post" enctype="multipart/form-data">
        @csrf
        <span class="form-content__label">商品の画像
            @if($item)
                <a class="image-link" href="{{ $item->img_url }}">
                    <img class="preview-image" id="preview-image" src="{{ $item->img_url }}">
                </a>
            @else
                <img class="preview-image" id="preview-image" style="display: none">
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
            <div class="category-buttons">
                @foreach($categories as $category)
                    <label>
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" @if(!empty($item) && in_array($category->id, $item->categories->pluck('id')->toArray())) checked @endif>
                        {{ $category->content }}
                    </label>
                @endforeach
            </div>
        </label>
        @error('category_ids')
            <div class="form-content__error">{{ $message }}</div>
        @enderror

        <label class="form-content__title">商品の状態
            <select class="form-content__select" name="condition_id">
                <option disabled {{ collect($conditions)->every('selected', false) ? 'selected' : '' }}>--- 選択してください ---</option>
                @foreach($conditions as $condition)
                    <option value="{{ $condition->id }}" {{ $selectedConditionId == $condition->id ? 'selected' : '' }}>{{ $condition->condition }}</option>
                @endforeach
            </select>
        </label>
        @error('condition_id')
            <div class="form-content__error">{{ $message }}</div>
        @enderror

        <h3 class="form-content__title">商品名と説明</h3>
        <label class="form-content__label">商品名
            <input class="form-content__input" type="text" name="name" value="{{ $item->name ?? '' }}">
        </label>
        @error('name')
            <div class="form-content__error">{{ $message }}</div>
        @enderror

        <label class="form-content__label">商品の説明
            <textarea class="form-content__textarea" name="description" cols="30" rows="5">{{ $item->description ?? '' }}</textarea>
        </label>
        @error('description')
            <div class="form-content__error">{{ $message }}</div>
        @enderror

        <h3 class="form-content__title">販売価格</h3>
        <label class="form-content__label">販売価格
            <div class="input-content">
                <input class="form-content__input input-price" type="text" id="price" name="price" value="{{ $item->price ?? '' }}" pattern="^[1-9][0-9]*$">
            </div>
        </label>
        @error('price')
            <div class="form-content__error">{{ $message }}</div>
        @enderror

        <input type="hidden" value="{{ Auth::id() }}" name="user_id">
        <button class="form-content__button" type="submit" onclick="return confirm('出品しますか？')">{{ $item ? '修正する' : '出品する' }}</button>
    </form>

    <script>
        function previewFile() {
            const preview = document.getElementById('preview-image');
            const file = document.getElementById('image').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener('DOMContentLoaded', function(){
            const selectedCategory = '{{ $item->category_id ?? '' }}';
            document.querySelectorAll('.category-button').forEach(button => {
                if(button.value === selectedCategory){
                    button.classList.add('selected');
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll('.category-button').forEach(button => {
            button.addEventListener('click', function(){
                document.querySelectorAll('.category-button').forEach(btn => btn.classList.remove('selected'));
                this.classList.add('selected');
                const selectedCategory = this.value;
                document.getElementById('category_id').value = selectedCategory;
                console.log('Selected category;', selectedCategory);
            });
        });
    </script>
@endsection
