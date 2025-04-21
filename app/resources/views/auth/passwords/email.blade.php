@extends('layouts.layout')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="bg-primary text-white p-5 rounded shadow" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4">パスワード変更</h2>

        @if (session('status'))
            <div class="alert alert-success text-white fw-bold">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- メールアドレス -->
            <div class="mb-4">
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

            <!-- 送信ボタン -->
            <div class="d-grid">
                <button type="submit" class="btn btn-light text-primary fw-bold">
                    パスワード変更メールを送信
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
