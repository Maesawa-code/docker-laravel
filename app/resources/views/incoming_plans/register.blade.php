@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">入荷予定登録</h2>

    <!-- 商品一覧エリア -->
    <div class="row">
        <div class="col-md-7">
            <div class="row row-cols-2 g-3">
                @foreach($products as $product)
                    <div class="col">
                        <div class="border rounded p-3 shadow-sm bg-light h-100 position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="fw-bold m-0">{{ $product->product_name }}</h5>
                                <span class="text-muted small">{{ $product->weight }}kg</span>
                            </div>
                            <div class="d-flex">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->product_name }}" class="me-3" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                    <input type="number" class="form-control mb-2" min="1" placeholder="個数" id="qty_{{ $product->id }}">
                                    <button class="btn btn-success" onclick="addItem({{ $product->id }}, '{{ $product->product_name }}', {{ $product->weight }})">追加する</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- リスト表示エリア -->
        <div class="col-md-5">
            <div class="bg-warning p-3 rounded shadow-sm">
                <h5 class="fw-bold mb-3">登録予定リスト</h5>
                <ul class="list-group mb-3" id="planList"></ul>

                <!-- 最終送信フォーム -->
                <form action="{{ route('incoming-plans.register') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plans" id="plansInput">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success fw-bold px-4 py-2">登録する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let plans = [];

    function addItem(productId, productName, productWeight) {
        const qty = document.getElementById(`qty_${productId}`).value;
        if (!qty || qty <= 0) {
            alert('個数を入力してください');
            return;
        }

        const totalWeight = (qty * productWeight).toFixed(2);

        const existingIndex = plans.findIndex(plan => plan.product_id === productId);
        if (existingIndex !== -1) {
            plans[existingIndex].quantity = qty;
            plans[existingIndex].weight = totalWeight;
        } else {
            plans.push({ product_id: productId, quantity: qty, name: productName, weight: totalWeight });
        }

        updatePlanList();
        document.getElementById(`qty_${productId}`).value = '';
    }

    function removeItem(index) {
        plans.splice(index, 1);
        updatePlanList();
    }

    function updatePlanList() {
        const planList = document.getElementById('planList');
        planList.innerHTML = '';
        plans.forEach((plan, index) => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
                ${plan.name}：${plan.quantity}個 ／ ${plan.weight}kg
                <button class="btn btn-sm btn-danger ms-3" onclick="removeItem(${index})">削除</button>
            `;
            planList.appendChild(li);
        });

        document.getElementById('plansInput').value = JSON.stringify(plans);
    }
</script>
@endsection
