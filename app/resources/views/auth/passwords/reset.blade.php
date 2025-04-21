@extends('layouts.layout')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="bg-primary text-white p-5 rounded shadow" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4">パスワード再設定</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- トークン -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- メールアドレス -->
            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- パスワード -->
            <div class="mb-3">
                <label for="password" class="form-label">新しいパスワード</label>
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password">

                @error('password')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- パスワード確認 -->
            <div class="mb-4">
                <label for="password-confirm" class="form-label">パスワード（確認）</label>
                <input id="password-confirm" type="password"
                       class="form-control"
                       name="password_confirmation" required autocomplete="new-password">
            </div>

            <!-- 再設定ボタン -->
            <div class="d-grid">
                <button type="submit" class="btn btn-light text-primary fw-bold">
                    パスワードを再設定する
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
