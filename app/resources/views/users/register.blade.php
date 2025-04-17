@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="bg-warning text-dark p-5 rounded shadow">
                <h2 class="text-center mb-4 fw-bold">一般社員登録</h2>

                <form action="{{ route('users.register') }}" method="POST">
                    @csrf

                    <!-- 名前 -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">名前</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <!-- メールアドレス -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">メールアドレス</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <!-- パスワード -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">パスワード</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <!-- パスワード確認 -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-bold">パスワード（確認）</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    <!-- 店舗ID -->
                    <div class="mb-4">
                        <label for="store_id" class="form-label fw-bold">店舗ID</label>
                        <input type="number" name="store_id" id="store_id" class="form-control" required>
                    </div>

                    <!-- 登録ボタン -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark fw-bold px-5 py-2">登録する</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
