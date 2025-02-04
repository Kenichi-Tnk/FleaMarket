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
・php artisan migrate --seed

エラーが発生の場合
・php artisan migrate:fresh --seed

storage内ファイル使用する為、シンボリックを作成します。
・php artisan storage:link
## 使用技術（実行環境）
Laravel: 8.83.8
PHP: 7.4.9
MYSQL: 8.0.26
nginx: 1.21.1

## ER図

## URL
開発環境: http://localhost/
ユーザー登録: http://localhost/register
ログイン画面: http://localhost/login
phpmyadmin: http://localhost:8080/
