# FleaMarket

## フリマアプリ

学習でフリマアプリ開発に挑戦しました。

会員登録、ログイン後出品や購入（仮）、商品のコメントができます。
<img width="1501" alt="Image" src="https://github.com/user-attachments/assets/920bcef9-78c5-4c33-9d86-6a661d63f36d" />


## git URL

HTTPS

https://github.com/Kenichi-Tnk/FleaMarket.git

SSH

git@github.com:Kenichi-Tnk/FleaMarket.git


## 環境構築

### Dockerのビルド
・docker-compose up -d --build

・Macをユーザーの方は
  
  docker-compose.ymlに 
  mysql:
    platform: linux/amd64

 phpmyadmin:
    platform: linux/amd64
    を追加してください。

### Laravel環境構築

・docker-compose exec php bash

・composer -v

・cp .env.example .env 環境変数を適宜変更

・php artisan key:generate

・php artisan migrate

・php artisan db:seed


### マイグレーション、シーディング
・php artisan migrate --seed</br>

### エラーが発生の場合
・php artisan migrate:fresh --seed</br>

### storage内ファイル使用する為、シンボリックを作成します。
・php artisan storage:link</br>

.env

DB_CONNECTION=mysql

DB_HOST=mysql

DB_PORT=3306

DB_DATABASE=laravel_db

DB_USERNAME=laravel_user

DB_PASSWORD=laravel_pass

AIL_MAILER=smtp

MAIL_HOST=sandbox.smtp.mailtrap.io

MAIL_PORT=2525

MAIL_USERNAME=*********eb

MAIL_PASSWORD=************e3

MAIL_ENCRYPTION=tls

MAIL_FROM_ADDRESS="from@example.com"

MAIL_FROM_NAME="${APP_NAME}"

## 使用技術（実行環境）
Laravel: 8.83.8

PHP: 7.4.9

MYSQL: 8.0.26

nginx: 1.21.1

## 実装機能
ログイン機能

会員登録機能

メール認証機能

商品出品機能

商品検索機能

## メール認証機能
mailtrapを使用

使用するにはmailtrapのサイトにてアカウント登録が必要です。

登録後Email Testing->inboxをクリックしてAdd InboxをクリックしてMy Inboxを作成

MAIL_MAILER=smtp

MAIL_HOST=sandbox.smtp.mailtrap.io

MAIL_PORT=2525

MAIL_USERNAME=*******f1eb

MAIL_PASSWORD=*******4e3

MAIL_ENCRYPTION=tls

と表示があるので

.envに入れてください。

会員登録後mailtrapにメールが届けば成功です。

## テーブル構成

## ER図
<img width="952" alt="Image" src="https://github.com/user-attachments/assets/165b738f-89e8-48c2-984c-5269fb582ed1" />

## テストユーザー
            メールアドレス       パスワード

ユーザー１: test@example.com  :   password

ユーザー２: test@test.com     :   password

## URL
開発環境: http://localhost/</>
ユーザー登録: http://localhost/register

ログイン画面: http://localhost/login

phpmyadmin: http://localhost:8080/

