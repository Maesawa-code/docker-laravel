@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="bg-warning p-5 rounded shadow text-dark">
        <div class="row justify-content-center align-items-center text-center">
            <!-- 商品画像 -->
            <div class="col-md-4 mb-4 mb-md-0 d-flex justify-content-center">
                <div class="bg-white p-3 rounded shadow" style="max-width: 300px;">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="商品画像" class="img-fluid rounded" style="max-height: 250px; object-fit: contain;">
                </div>
            </div>

            <!-- 商品情報 -->
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">{{ $product->name }}</h2>
                <h4 class="mb-4">重さ：{{ $product->weight }} kg</h4>

                <div class="d-flex justify-content-center gap-3 mb-4">
                    <!-- 編集ボタン -->
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success fw-bold">編集</a>

                    <!-- 削除ボタン -->
                    <form action="#" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger fw-bold">削除</button>
                    </form>
                </div>

                <!-- 戻るボタン -->
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg fw-bold px-5 py-3">
                        ← 商品一覧に戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
