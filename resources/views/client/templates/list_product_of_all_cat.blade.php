@php
use App\Model\CatProductModel;
use App\Model\ProductModel;
$listAllCatProduct=(new CatProductModel)->listItems(null,['task'=>'list-items-front-end']);
@endphp
<div class="ls-product-of-home">
    @foreach ($listAllCatProduct as $itemCat)
    @if ($itemCat['parent_id']==1)
    @php
        $catId=$itemCat['id'];
        $item=(new ProductModel)->listItems(['cat_id'=>$catId,'limit'=>8],['task'=>'frontend-list-items']);
    @endphp
    @if (count($item) > 0)
    <div class="section-head mb-2 mt-3">
        <h3 class="section-title">{{$itemCat['name']}}</h3>
        <span class="border-bottom-title "></span>
    </div>
    <div class="section-detail">
        <ul class="list-item clearfix">
            @foreach ($item as $val)
            @include("client.partial.product_in_content")
            @endforeach
        </ul>
    </div>
    @endif
    @endif
    @endforeach
</div>