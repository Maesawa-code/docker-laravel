@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">入荷予定の編集</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="bg-warning p-4 rounded shadow text-dark">
                <form action="{{ route('incoming-plans.update', $plan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- 商品名（表示のみ） -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">商品名</label>
                        <div class="form-control bg-light">{{ $plan->product->product_name }}</div>
                    </div>

                    <!-- 数量入力 -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label fw-bold">数量</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $plan->quantity) }}" min="1" required>
                    </div>

                    <!-- ボタン -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success fw-bold px-4 py-2">更新する</button>
                        <a href="{{ route('incoming-plans.show', ['date' => $plan->planned_date, 'store' => $plan->store_id]) }}" class="btn btn-secondary fw-bold ms-3">戻る</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
