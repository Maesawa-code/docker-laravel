@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- 黄色と茶色の中間ボックス -->
            <div class="bg-warning text-dark p-5 rounded shadow">
                <h2 class="text-center mb-4 fw-bold">商品編集</h2>

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- 商品名 -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">商品名</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="form-control" required>
                    </div>

                    <!-- 重さ -->
                    <div class="mb-3">
                        <label for="weight" class="form-label fw-bold">重さ（kg）</label>
                        <input type="number" name="weight" id="weight" value="{{ old('weight', $product->weight) }}" class="form-control" step="0.01" required>
                    </div>

                    <!-- 現在の画像 -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">現在の画像</label><br>
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="現在の画像" style="max-height: 150px;" class="rounded">
                    </div>

                    <!-- 新しい画像 -->
                    <div class="mb-4">
                        <label for="image" class="form-label fw-bold">新しい画像（変更する場合のみ）</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>

                    <!-- 更新ボタン -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success fw-bold px-5 py-2">更新する</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
