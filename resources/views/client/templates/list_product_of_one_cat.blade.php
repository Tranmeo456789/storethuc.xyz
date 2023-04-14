@php
use App\Model\CatProductModel;
use App\Model\ProductModel;
$itemCatProduct=(new CatProductModel)->getItem(['slug'=>$slug],['task'=>'get-item-slug']);
@endphp
<div class="ls-product-of-home">
    <div class="section-head mb-2">
        <h3 class="section-title">{{$itemCatProduct['name']}}</h3>
        <span class="border-bottom-title "></span>
    </div>
    <div class="section-detail">
        <ul class="list-item clearfix">
            @php
            $catId=$itemCatProduct['id'];
            $item=(new ProductModel)->listItems(['cat_id'=>$catId],['task'=>'frontend-list-items']);
            @endphp
            @foreach ($item as $val)
            @include("client.partial.product_in_content")
            @endforeach
        </ul>
    </div>
</div>