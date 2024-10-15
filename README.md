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

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

## 他のリポジトリ

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## 機能一覧

ログイン機能、メール認証、お気に入り追加/削除、予約追加/変更、検索、並び替え、レビュー、
リマインドメール送信、QRコードで予約認証、決済機能
管理者権限で店舗代表者作成、ユーザー一覧閲覧、お知らせメール送信
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


