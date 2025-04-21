@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">在庫一覧</h2>

    <!-- 🔍 検索フォーム -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form method="GET" action="{{ route('inventories.index') }}" class="input-group">
                <input type="text" name="keyword" class="form-control"
                    placeholder="{{ Auth::user()->role === 'admin' ? '商品名・店舗名で検索' : '商品名で検索' }}"
                    value="{{ request('keyword') }}">
                <button type="submit" class="btn btn-primary fw-bold">検索</button>
            </form>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($inventories as $inventory)
            <div class="col">
                <div class="bg-warning p-3 rounded shadow h-100 d-flex flex-column justify-content-between">
                    <div class="d-flex">
                        <div style="width: 100px; height: 100px; overflow: hidden; border-radius: 8px;" class="me-3 bg-white">
                            <img src="{{ asset('storage/' . $inventory->product->image_path) }}" alt="商品画像" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="text-dark">
                            <h5 class="fw-bold mb-2">{{ $inventory->product->product_name }}</h5>
                            <p class="mb-1">数量：{{ $inventory->quantity }} 個</p>
                            <p class="mb-0">重量：{{ $inventory->weight }} kg</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-primary btn-sm fw-bold"
                            data-bs-toggle="modal"
                            data-bs-target="#inventoryModal"
                            data-id="{{ $inventory->id }}">
                            詳細を見る
                        </button>
                        <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" onsubmit="return confirm('この在庫を削除してもよろしいですか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm fw-bold">削除</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- 共通モーダル -->
<div class="modal fade" id="inventoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="inventoryModalContent">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-center w-100">商品詳細</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-body bg-warning rounded text-center py-4" id="modalBodyContent">
                読み込み中...
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('inventoryModal');
    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const modalBody = document.getElementById('modalBodyContent');

        // Ajaxで取得
        fetch(`{{ url('/inventories') }}/${id}`)
            .then(res => res.json())
            .then(data => {
                modalBody.innerHTML = `
                    <img src="/storage/${data.image_path}" class="img-fluid rounded mb-3" style="max-height:200px; object-fit:cover;">
                    <p class="fw-bold fs-5">商品名：${data.product_name}</p>
                    <p class="fw-bold">数量：${data.quantity} 個</p>
                    <p class="fw-bold">重量：${data.weight} kg</p>
                    <p class="fw-bold">店舗：${data.store_name}</p>
                `;
            })
            .catch(() => {
                modalBody.innerHTML = '<p class="text-danger fw-bold">読み込みに失敗しました。</p>';
            });
    });
});
</script>
@endsection
