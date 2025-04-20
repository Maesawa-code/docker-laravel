@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">在庫一覧</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($inventories as $inventory)
            <div class="col">
                <div class="d-flex bg-warning p-3 rounded shadow h-100 align-items-center justify-content-between">
                    <!-- 商品情報 -->
                    <div class="d-flex align-items-center">
                        <!-- 商品画像 -->
                        <div style="width: 100px; height: 100px; overflow: hidden; border-radius: 8px;" class="me-3 bg-white">
                            <img src="{{ asset('storage/' . $inventory->product->image_path) }}" alt="商品画像" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <!-- 在庫情報 -->
                        <div class="text-dark">
                            <h5 class="fw-bold mb-2">{{ $inventory->product->product_name }}</h5>
                            <p class="mb-1">数量：{{ $inventory->quantity }} 個</p>
                            <p class="mb-0">重量：{{ $inventory->weight }} kg</p>
                        </div>
                    </div>

                    <!-- 削除ボタン -->
                    <form action="#" method="POST" onsubmit="return confirm('この在庫を削除してもよろしいですか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm fw-bold">削除</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
