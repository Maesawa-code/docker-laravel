@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        <div class="col-md-4">
            <a href="{{ route('inventories.index') }}" class="btn btn-warning text-dark fw-bold fs-3 py-5 w-100">
                在庫一覧
            </a>
        </div>
        <div class="col-md-4">
            <a href="#" class="btn btn-warning text-dark fw-bold fs-3 py-5 w-100">
                入荷予定
            </a>
        </div>
        <div class="col-md-4">
            <a href="#" class="btn btn-warning text-dark fw-bold fs-3 py-5 w-100">
                在庫一覧（全店舗）
            </a>
        </div>
    </div>

    <div class="row g-5 justify-content-start mt-2">
        <div class="col-md-4">
            <a href="#" class="btn btn-warning text-dark fw-bold fs-3 py-5 w-100">
                社員
            </a>
        </div>
    </div>
</div>
@endsection
