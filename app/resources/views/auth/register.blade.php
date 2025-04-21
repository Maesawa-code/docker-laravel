@extends('layouts.layout')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="bg-primary text-white p-5 rounded shadow" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4">新規登録</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- 名前 -->
            <div class="mb-3">
                <label for="name" class="form-label">名前</label>
                <input id="name" type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- メールアドレス -->
            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email">

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

            <!-- 店舗選択 -->
            <div class="mb-4">
                <label for="store_id" class="form-label">所属店舗</label>
                <select id="store_id" name="store_id"
                        class="form-select @error('store_id') is-invalid @enderror" required>
                    <option value="">店舗を選択してください</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                            {{ $store->name }}
                        </option>
                    @endforeach
                </select>
                @error('store_id')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- 登録ボタン -->
            <div class="d-grid">
                <button type="submit" class="btn btn-light text-primary fw-bold">
                    登録する
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
