<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Rese

ある企業のグループ会社の飲食店予約サービス

<img src="/images/Rese_Top.png" width="600">

## 作成した目的

外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。


## アプリケーションURL

## 機能一覧

ログイン機能、メール認証、お気に入り追加/削除、予約追加/変更、レビュー、<br/>
リマインドメール送信、QRコードで予約認証、決済機能 <br/>
管理者権限で店舗代表者作成、お知らせメール送信<br/>
店舗代表者権限で店舗情報の作成/更新

## 使用技術

docker,Laravel8.x,PHP7.4,laravel-fortify,laravel-permission,Stripe,javascript

## テーブル設計

<img src="/images/table.png" width="600">

## ER図

<img src="/images/ER.drawio.png" width="600">

## 開発環境構築
### コマンドライン上
```
$ git clone https://github.com/satouyouhei/Rese.git
```

```php
$ docker compose up -d --build
$ docker compose exec php bash
```
### PHPコンテナ内
```php
$ composer install
```

### src上
```php
$ cp .env.local .env
```

### PHPコンテナ内
```php
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
```

### PHPコンテナ内(リマインダー予約を適用させるため)
```php
$ php artisan schedule:work
```

## ダミーデータの説明

ユーザー一覧
<ol>
    <li>管理者　　　email: admin@admin.com</li>
    <li>店舗代表者　email: shop@shop.com</li>
    <li>ユーザー　　　email: test@test.com</li>
</ol>
※パスワードは全て"password"でログインできます。

## 店舗の新規作成方法

<ol>
    <li>管理者でログイン</li>
    <li>”店舗代表者作成”で店舗代表者権限を持つユーザを作成</li>
    <li>店舗代表者でログイン</li>
    <li>店舗情報の作成で作成する</li>
</ol>

### csvファイルをインポートして作成する
<li>管理者でログイン</li>
<li>管理者専用ページの新規店舗追加</li>
<li>csvファイルを作成し、選択</br>
<a href="images/csv_import用 - シート2.csv
">[サンプルCSVファイル]</a>←クリック後、右上の"Download raw file"ボタンでダウンロード</li>
<li>インポートボタンをクリック</li>
