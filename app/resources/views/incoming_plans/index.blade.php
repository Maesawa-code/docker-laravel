@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">入荷予定一覧</h2>

    <!-- 入荷予定登録ボタン & 検索フォーム（横並び） -->
    <div class="row align-items-center mb-4">
        <!-- 登録ボタン -->
        <div class="col-md-4 text-center mb-2 mb-md-0">
            <a href="{{ route('incoming-plans.register.form') }}" class="btn btn-success fw-bold w-100">
                + 入荷予定を登録する
            </a>
        </div>

        <!-- 検索フォーム -->
        <div class="col-md-8">
            <form method="GET" action="{{ route('incoming-plans.index') }}" class="row g-2">
                <div class="col-md-6">
                    <input type="text" name="keyword" class="form-control" placeholder="商品名・店舗名" value="{{ request('keyword') }}">
                </div>
                <div class="col-md-4">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary fw-bold w-100">検索</button>
                </div>
            </form>
        </div>
    </div>

    @if ($incomingPlanGroups->isEmpty())
        <div class="alert alert-info text-center fw-bold">
            現在、入荷予定はありません。
        </div>
    @else
        <div class="row row-cols-1 g-4">
            @foreach ($incomingPlanGroups as $groupKey => $plans)
                @php
                    [$date, $storeName] = explode('_', $groupKey);
                @endphp

                <div class="col">
                    <div class="bg-warning p-4 rounded shadow text-dark d-flex justify-content-between align-items-center">
                        <!-- 日付と店舗 -->
                        <div class="fs-4 fw-bold">
                            入荷予定日：{{ \Carbon\Carbon::parse($date)->format('Y年m月d日') }}（{{ $storeName }}）
                        </div>

                        <!-- 確定済みバッジと詳細ボタン -->
                        <div class="d-flex align-items-center gap-3">
                            @if ($plans->every(fn($plan) => $plan->is_confirmed))
                                <div class="btn btn-success fs-5 fw-bold disabled" style="pointer-events: none;">
                                    ✅ 入荷確定済み
                                </div>
                            @endif

                            <a href="{{ route('incoming-plans.show', [
                                'date' => $date,
                                'store' => $plans->first()->store_id
                            ]) }}" class="btn btn-primary fw-bold">
                                詳細を見る
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
