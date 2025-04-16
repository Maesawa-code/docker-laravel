@extends('layouts.layout') 

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="bg-primary text-white p-5 rounded shadow" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4">ログイン</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- メールアドレス -->
            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- パスワード -->
            <div class="mb-3">
                <label for="password" class="form-label">パスワード</label>
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">

                @error('password')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                       {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    ログイン状態を保持する
                </label>
            </div>

            <!-- ボタン -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-light text-primary fw-bold">
                    ログイン
                </button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link text-white text-center" href="{{ route('password.request') }}">
                        パスワードを忘れた方はこちら
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
