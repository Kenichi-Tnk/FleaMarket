# FleaMarket
## 環境構築
Dockerのビルド
・git clone git@github.com:
・docker-compose up -d --build

Laravel環境構築
・docker-compose exec php bash
・composer install
・cp .env.example .env 環境変数を適宜変更
・php artisan key:generate
・php artisan migrate
・php artisan db:seed


　マイグレーション、シーディング
## 使用技術
Laravel8.83.8
PHP8.2.11
MYSQL8.0.26
nginx1.21.1

## ER図

## URL
開発環境: http://localhost/
ユーザー登録: http://localhost/register
ログイン画面: http://localhost/login
phpmyadmin: http://localhost:8080/
