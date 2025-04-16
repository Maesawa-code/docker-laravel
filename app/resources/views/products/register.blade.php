@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- 黄色と茶色の中間ボックス -->
            <div class="bg-warning text-dark p-5 rounded shadow">
                <h2 class="text-center mb-4 fw-bold">商品登録</h2>

                <form action="{{ route('products.register') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- 商品名 -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">商品名</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <!-- 重さ -->
                    <div class="mb-3">
                        <label for="weight" class="form-label fw-bold">重さ（kg）</label>
                        <input type="number" name="weight" id="weight" class="form-control" step="0.01" required>
                    </div>

                    <!-- 画像 -->
                    <div class="mb-4">
                        <label for="image" class="form-label fw-bold">商品画像</label>
                        <input type="file" name="image" id="image" class="form-control" required>
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
