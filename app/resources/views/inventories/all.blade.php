@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">在庫一覧（全店舗）</h2>

    <!-- 検索フォーム -->
    <div class="text-center mb-4">
        <form method="GET" action="{{ route('inventories.all') }}" class="d-flex justify-content-center gap-2">
            <input type="text" name="keyword" value="{{ old('keyword', $keyword ?? '') }}" class="form-control w-50" placeholder="商品名または店舗名で検索">
            <button type="submit" class="btn btn-primary fw-bold px-4" style="white-space: nowrap;">検索</button>
        </form>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($inventories as $inventory)
            <div class="col">
                <div class="bg-warning p-3 rounded shadow h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <!-- モーダルトリガー -->
                        <div class="d-flex align-items-center w-100"
                             style="cursor: pointer;"
                             data-bs-toggle="modal"
                             data-bs-target="#inventoryModal{{ $inventory->id }}">

                            <div style="width: 100px; height: 100px; overflow: hidden; border-radius: 8px;" class="me-3 bg-white">
                                <img src="{{ asset('storage/' . $inventory->product->image_path) }}" alt="商品画像" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <div class="text-dark">
                                <h5 class="fw-bold mb-2">{{ $inventory->product->product_name }}</h5>
                                <p class="mb-1">数量：{{ $inventory->quantity }} 個</p>
                                <p class="mb-0">重量：{{ $inventory->weight }} kg</p>
                                <p class="mb-0">店舗：{{ $inventory->store->name ?? '不明' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- モーダル -->
            <div class="modal fade" id="inventoryModal{{ $inventory->id }}" tabindex="-1" aria-labelledby="inventoryModalLabel{{ $inventory->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold text-center w-100" id="inventoryModalLabel{{ $inventory->id }}">
                                商品詳細：{{ $inventory->product->product_name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                        </div>
                        <div class="modal-body bg-warning rounded text-center py-4">
                            <img src="{{ asset('storage/' . $inventory->product->image_path) }}" alt="商品画像" class="img-fluid rounded mb-3" style="max-height: 200px; object-fit: cover;">
                            <p class="fw-bold fs-5">商品名：{{ $inventory->product->product_name }}</p>
                            <p class="fw-bold">数量：{{ $inventory->quantity }} 個</p>
                            <p class="fw-bold">重量：{{ $inventory->weight }} kg</p>
                            <p class="fw-bold">店舗：{{ $inventory->store->name ?? '不明' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
