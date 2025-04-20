@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">入荷予定一覧</h2>

    <!-- 登録ボタン -->
    <div class="text-center mb-5">
        <a href="#" class="btn btn-success fw-bold px-4 py-2">
            ＋ 入荷予定を登録する
        </a>
    </div>

    @if($incomingPlans->isEmpty())
        <div class="alert alert-info text-center fw-bold">
            現在、入荷予定はありません。
        </div>
    @else
        <div class="row row-cols-1 g-4">
            @foreach($incomingPlans as $incomingPlan)
                <div class="col">
                    <div class="bg-warning p-4 rounded shadow text-dark d-flex justify-content-between align-items-center">
                        <div class="fs-4 fw-bold">
                            入荷予定日：{{ \Carbon\Carbon::parse($incomingPlan->planned_date)->format('Y年m月d日') }}
                        </div>

                        <div>
                            <a href="{{ route('incoming-plans.show', $incomingPlan->id) }}" class="btn btn-primary fw-bold">
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
