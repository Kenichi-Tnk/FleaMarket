# FleaMarket

## フリマアプリ

学習でフリマアプリ開発に挑戦しました。

会員登録、ログイン後出品や購入（仮）、商品のコメントができます。



## git URL

HTTPS

https://github.com/Kenichi-Tnk/FleaMarket.git

SSH

git@github.com:Kenichi-Tnk/FleaMarket.git


## 環境構築

Dockerのビルド</br>
・docker-compose up -d --build</br>
  Macをユーザーの方は</br>
  docker-compose.ymlに 
  mysql:
    platform: linux/amd64

 phpmyadmin:
    platform: linux/amd64
    を追加してください。
  '''


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

## テーブル構成

## ER図




## URL
開発環境: http://localhost/</>
ユーザー登録: http://localhost/register

ログイン画面: http://localhost/login

phpmyadmin: http://localhost:8080/

