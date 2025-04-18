@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="bg-warning text-dark p-5 rounded shadow">
                <h2 class="text-center mb-4 fw-bold">商品登録</h2>

                <!-- エラーメッセージ表示 -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.register') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- 商品名 -->
                    <div class="mb-3">
                        <label for="product_name" class="form-label fw-bold">商品名</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name') }}">
                    </div>

                    <!-- 重さ -->
                    <div class="mb-3">
                        <label for="weight" class="form-label fw-bold">重さ（kg）</label>
                        <input type="number" name="weight" id="weight" class="form-control" step="0.01" value="{{ old('weight') }}">
                    </div>

                    <!-- 画像 -->
                    <div class="mb-4">
                        <label for="image" class="form-label fw-bold">商品画像</label>
                        <input type="file" name="image" id="image" class="form-control">
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
