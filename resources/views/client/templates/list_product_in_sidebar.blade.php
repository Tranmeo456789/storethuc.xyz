@php
use App\Model\ProductModel;
use App\Product;
$params['limit']=8;
$item=(new ProductModel)->listItems($params,['task'=>'frontend-list-items']);
@endphp
<div class="section-head">
        <h3 class="section-title">Sản phẩm bán chạy</h3>
    </div>
    <div class="section-detail">
        <ul class="list-item">
        @foreach ($item as $val)
            @include("client.partial.product_in_sidebar")
        @endforeach
    </ul>
</div>
    