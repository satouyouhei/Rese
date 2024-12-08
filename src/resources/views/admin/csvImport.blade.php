@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="css/csv_import.css">
@endsection

@section('content')
<h2 class="title">新規店舗追加</h2>
<div class="explanation-content">
    <p class="explanation-text">csvをインポートすることで、店舗情報を追加できます</p>
    <p class="explanation-text">※画像URLはjpeg,pngのみアップロード可能です</p>
    <p class="explanation-text">※店舗情報の上書きではなく新規店舗追加するための機能です。</p>
</div>

<form action="{{ route('csvImport') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".csv" class="input-file" required>
    <button type="submit" class="input-button">インポート</button>
</form>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('errors'))
<div class="alert alert-error">
    <ul>
        @foreach (session('errors') as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection