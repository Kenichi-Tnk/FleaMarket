<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>coachtechフリマサイト</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <a class="header__link" href="/">
            <img class="header__logo" src="{{ asset('/storage/img/icons/logo.svg') }}" alt="COACHTECH">
        </a>
        @if(!request()->is('register', 'login', 'purchase/address/*', 'sell'))
            <form class="header__search" action="/search" method="get">
                @csrf
                <input class="search__item" type="text" name="searchText" placeholder="なにをお探しですか？">
            </form>
            <nav class="header__nav">
                <ul class="nav__list">
                    @if (Auth::check())
                        <form action="/logout" method="post">
                            @csrf
                            <li class="nav__item">
                                <button class="nav__item-button" type="submit">ログアウト</button>
                            </li>
                        </form>
                        <li class="nav__item">
                            <a class="nav__item-link" href="/mypage">マイページ</a>
                        </li>
                    @else
                        <li class="nav__item">
                            <a class="nav__item-link" href="/login">ログイン</a>
                        </li>
                        <li class="nav__item">
                            <a class="nav__item-link" href="/register">会員登録</a>
                        </li>
                    @endif
                    <li class="nav__item">
                        <a class="nav__item-link" href="/sell">出品</a>
                    </li>
                </ul>
            </nav>

            <a class="search-link">
                <img class="search-icon" src="{{ asset('storage/img/icons/search.svg') }}">
            </a>

            <input class="menu-btn" type="checkbox" id="menu-btn">
            <label class="menu-icon" for="menu-btn">
                <span class="navicon"></span>
            </label>
            <ul class="menu__list">
                @if(Auth::check())
                <form action="/logout" method="post">
                    @csrf
                    <li class="menu__item">
                        <button class="menu__item-button" type="submit" >
                            ログアウト
                        </button>
                    </li>
                </form>
                <li class="menu__item"><a class="menu__item-link" href="/mypage">マイページ</a></li>
                @else
                    <li class="menu__item">
                        <a class="menu__item-link" href="/login">ログイン</a>
                    </li>
                    <li class="menu__item">
                        <a class="menu__item-link" href="/register">会員登録</a>
                    </li>
                @endif
                <li>
                    <a class="menu__item-link" href="/sell">出品</a>
                </li>
            </ul>
        @endif
    </header>

    <main>
        <form class="search-form" id="search-form" action="/search" method="get" style="display: none;">
            @csrf
            <input class="search-input" type="text" name="searchText" placeholder="何をお探しですか？">
        </form>

        <script>
            document.querySelector('.search-link').addEventListener('click', function() {
                var searchForm = document.getElementById('search-form');
                if (searchForm.style.display === 'none' || searchForm.style.display === '') {
                    searchForm.style.display = 'block';
                } else {
                    searchForm.style.display = 'none';
                }
            });
        </script>
        @yield('main')
        @yield('content')
    </main>
</body>
</html>
