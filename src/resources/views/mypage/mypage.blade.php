@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminShop.css') }}">
@endsection

@section('header')
    @unless ($user->hasRole('admin|shop'))
        <form action="/pay" method="POST">
            @csrf
            <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ config('services.stripe.key') }}"
                data-amount="100"
                data-name="決済テスト"
                data-label="決済をする"
                data-description="これはデモ決済です"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto"
                data-currency="JPY">
            </script>
        </form>
    @endunless
@endsection

@section('content')
    @if (isset($roleView))
        @include($roleView,['user' => $user])
    @else
        @include('user',['reservations'=>$reservations,'histories'=>$histories,'shops'=>$shops])
    @endif
@endsection