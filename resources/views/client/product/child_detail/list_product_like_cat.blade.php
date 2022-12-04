@php
use App\Product_cat;
use App\Product;
$products=Product::where('slug',$slug1)->get();
foreach($products as $product1){
    $product=$product1;
}
$product_like_cat=Product::where([
                ['id','<>',$product->id],
            ])->inRandomOrder()->limit(7)->get();
@endphp
@if ($product_like_cat->count()>0)
<div class="section-head">
    <h3 class="section-title">Cùng chuyên mục</h3>
</div>
<div class="section-detail">
    <ul class="list-item">
        @foreach ($product_like_cat as $item5)
        <li>
            @if ($item5->thumbnail)
            <a href="{{route('cat1.product',$item5->slug)}}" title="" class="thumb wp-img-50pt">
                <img src="{{asset($item5->thumbnail)}}">
            </a>
            @endif
            <a href="{{route('cat1.product',$item5->slug)}}" title="" class="product-name truncate2">{{$item5->name}}</a>
            <div class="price">
                <span class="new">{{number_format($item5['price_current'], 0, "" ,"." )}}đ / {{$item5['unit']}}</span>
                @if ($item5->price_old)
                <span class="old">{{number_format($item5['price_old'], 0, "" ,"." )}}đ</span>
                @endif
            </div>
            <div class="action clearfix">
                <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                <a href="" title="" class="buy-now fl-right">Mua ngay</a>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endif