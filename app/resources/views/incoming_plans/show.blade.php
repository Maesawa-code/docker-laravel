@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">
        入荷予定登録日：{{ \Carbon\Carbon::parse($date)->format('Y年m月d日') }}（{{ $store->name }}）
    </h2>

    <!-- 一括確定ボタン（未確定のものが含まれている場合のみ表示） -->
    @if ($plans->contains(fn($plan) => !$plan->is_confirmed))
        <div class="d-flex justify-content-center mb-4">
            <form action="{{ route('incoming-plans.confirm', $plans->first()->id) }}" method="POST" onsubmit="return confirm('この入荷予定を確定してもよろしいですか？')">
                @csrf
                <button type="submit" class="btn btn-success fw-bold px-4 py-2">
                    入荷を確定する
                </button>
            </form>
        </div>
    @endif

    <!-- 商品ごとの入荷予定 -->
    <div class="bg-warning p-4 rounded shadow">
        @foreach($plans as $plan)
            <div class="d-flex align-items-center justify-content-between mb-4 bg-light rounded p-3">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/' . $plan->product->image_path) }}"
                         alt="{{ $plan->product->product_name }}"
                         style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px;"
                         class="me-4">

                    <div class="me-4 fs-5 fw-bold">
                        {{ $plan->product->product_name }}
                    </div>

                    <div class="me-4 fs-5">
                        個数：{{ $plan->quantity }}
                    </div>

                    <div class="fs-5">
                        重量：{{ $plan->weight }} kg
                    </div>
                </div>

                <!-- 商品ごとの操作ボタン -->
                <div class="d-flex gap-2 align-items-center">
                    @if (!$plan->is_confirmed)
                        <a href="{{ route('incoming-plans.edit', $plan->id) }}" class="btn btn-primary">編集</a>

                        <form action="{{ route('incoming-plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('この商品を削除してもよろしいですか？')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                    @else
                        <span class="text-success fw-bold">✅ 確定済み</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
