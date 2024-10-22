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

## 他のリポジトリ

## 機能一覧

ログイン機能、メール認証、お気に入り追加/削除、予約追加/変更、レビュー、<br/>
リマインドメール送信、QRコードで予約認証、決済機能 <br/>
管理者権限で店舗代表者作成、お知らせメール送信<br/>
店舗代表者権限で店舗情報の作成/更新

## 使用技術

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## テーブル設計

<img src="/images/table.png" width="600">

## ER図

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 環境構築

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
