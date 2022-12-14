@php
use App\Model\CatProductModel;

$listCatProduct=(new CatProductModel)->listItems(null,['task'=>'list-items-front-end']);

@endphp
<div class="section" id="category-product-wp">
    <div class="section-head">
        <h3 class="section-title">Danh mục sản phẩm</h3>
    </div>
    <div class="secion-detail">
        <ul class="list-item">
            @foreach ($listCatProduct as $itemCat)
            @if ($itemCat['parent_id']==1)
            <li>
                <a href="{{route('cat0.product',$itemCat->slug)}}" title="" name='cat0_product' value="{{$itemCat['id']}}">{{$itemCat['name']}}</a>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
</div>
<div class="section" id="selling-wp">
    @include("client.templates.list_product_in_sidebar")  
</div>
<div class="section" id="banner-wp">
    <div class="section-detail">
        <a href="" title="" class="thumb">
            <img src="{{asset('images/banner_doc3.png')}}" alt="">
        </a>
        <a href="" title="" class="thumb">
            <img src="{{asset('images/banner.png')}}" alt="">
        </a>
    </div>
</div>