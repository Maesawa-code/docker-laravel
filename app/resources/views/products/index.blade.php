@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">商品一覧</h2>
    
    <!-- 登録ボタン -->
    <div class="text-center mb-5">
        <a href="{{ url('/products/register') }}" class="btn btn-success fw-bold px-4 py-2">
            ＋ 商品を登録する
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($products as $product)
            <div class="col">
                <!-- 商品詳細ページへのリンク -->
                <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                    <div class="d-flex bg-warning p-3 rounded shadow h-100 align-items-center">
                        <!-- 商品画像 -->
                        <div style="width: 100px; height: 100px; overflow: hidden; border-radius: 8px;" class="me-3 bg-white">
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="商品画像" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <!-- 商品情報 -->
                        <div class="text-dark">
                            <h5 class="fw-bold mb-2">{{ $product->name }}</h5>
                            <p class="mb-0">重さ：{{ $product->weight }} kg</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
