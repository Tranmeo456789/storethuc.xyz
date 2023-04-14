@php
use App\Model\ProductModel;
$params['limit']=6;
$item=(new ProductModel)->listItems($params,['task'=>'frontend-list-items']);
@endphp
<div class="section-head mt-3 mb-2">
    <h3 class="section-title">Sản phẩm nổi bật</h3>
    <span class="border-bottom-title "></span>
</div>
<div class="section-detail">
    <ul class="list-item">
        @foreach ($item as $val)
        @include("client.partial.product_in_content")
        @endforeach
    </ul>
</div>