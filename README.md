# FleaMarket
## 環境構築
Dockerのビルド</br>
・git clone git@github.com:</br>
・docker-compose up -d --build</br>

Laravel環境構築</br>
・docker-compose exec php bash</br>
・composer install</br>
・cp .env.example .env 環境変数を適宜変更</br>
・php artisan key:generate</br>
・php artisan migrate</br>
・php artisan db:seed</br>


マイグレーション、シーディング</br>
・php artisan migrate --seed</br>

エラーが発生の場合</br>
・php artisan migrate:fresh --seed</br>

storage内ファイル使用する為、シンボリックを作成します。</br>
・php artisan storage:link</br>
## 使用技術（実行環境）
Laravel: 8.83.8</br>
PHP: 7.4.9</br>
MYSQL: 8.0.26</br>
nginx: 1.21.1</br>

## ER図

## URL
開発環境: http://localhost/</br>
ユーザー登録: http://localhost/register</br>
ログイン画面: http://localhost/login<br>
phpmyadmin: http://localhost:8080/<br>
