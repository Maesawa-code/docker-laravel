@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">一般社員一覧</h2>

    <!-- 社員登録ボタン + 検索フォーム -->
    <div class="row align-items-center mb-5">
        <!-- 登録ボタン -->
        <div class="col-md-4 text-center mb-2 mb-md-0">
            <a href="{{ route('users.register.form') }}" class="btn btn-success fw-bold w-100">
                ＋ 社員を登録する
            </a>
        </div>

        <!-- 検索フォーム -->
        <div class="col-md-8">
            <form method="GET" action="{{ route('users.index') }}" class="row g-2">
                <div class="col-md-9">
                    <input type="text" name="keyword" class="form-control" placeholder="名前・店舗名で検索" value="{{ request('keyword') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary fw-bold w-100">検索</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row row-cols-1 g-4">
        @foreach($users as $user)
            <div class="col">
                <div class="bg-warning p-4 rounded shadow text-dark d-flex justify-content-between align-items-center flex-wrap">
                    <div class="fs-4 fw-bold">ID：{{ $user->id }}</div>
                    <div class="fs-4 fw-bold">名前：{{ $user->name }}</div>
                    <div class="fs-4 fw-bold d-flex align-items-center">
                        店舗名：{{ $user->store->name ?? '未登録' }}
                        <!-- 削除ボタン -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="ms-3" onsubmit="return confirm('この社員を削除してもよろしいですか？')">
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
@endsection
