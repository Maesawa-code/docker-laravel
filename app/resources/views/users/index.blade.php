@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">一般社員一覧</h2>

    <!-- 社員登録ボタン -->
    <div class="text-center mb-5">
        <a href="{{ route('users.register.form') }}" class="btn btn-success fw-bold px-4 py-2">
            ＋ 社員を登録する
        </a>
    </div>

    <div class="row row-cols-1 g-4">
        @foreach($users as $user)
            <div class="col">
                <div class="bg-warning p-4 rounded shadow text-dark d-flex justify-content-between align-items-center">
                    <div class="fs-3 fw-bold">ID：{{ $user->id }}</div>
                    <div class="fs-3 fw-bold">名前：{{ $user->name }}</div>
                    <div class="fs-3 fw-bold d-flex align-items-center">
                        店舗名：{{ $user->store->name ?? '未登録' }}
                        <!-- 削除ボタン -->
                        <form action="#" method="POST" class="ms-3" onsubmit="return confirm('この社員を削除してもよろしいですか？')">
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
