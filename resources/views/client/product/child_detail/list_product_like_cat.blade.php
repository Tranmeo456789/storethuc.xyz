@php
use App\Model\ProductModel;
$catIdProductCurrent=$productCurrent['cat_id'];
$listProductLikeCat=(new ProductModel)->listItems(['cat_id'=>$catIdProductCurrent],['task'=>'frontend-list-items']);
@endphp
@if ($listProductLikeCat->count() > 0)
<div class="section-head">
    <h3 class="section-title">Cùng chuyên mục</h3>
</div>
<div class="section-detail">
    <ul class="list-item">
        @foreach ($listProductLikeCat as $val)
            @include("client.partial.product_in_content")
        @endforeach
    </ul>
</div>
@endif