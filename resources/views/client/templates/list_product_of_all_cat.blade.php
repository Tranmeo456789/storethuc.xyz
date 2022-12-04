@php
use App\Product_cat;
use App\Product;
$_SESSION['cat_product']=Product_cat::all();
$_SESSION['product']=Product::all();
@endphp
<div class="ls-product-of-home">
    @foreach ($_SESSION['cat_product'] as $cat_product)
    @if ($cat_product['parent_id']==0)
    <div class="section-head">
        <h3 class="section-title">{{$cat_product['title']}}</h3>
        <span class="border-bottom-title "></span>
    </div>
    <div class="section-detail">
        <ul class="list-item clearfix">
            @php
            $count = 1;
            @endphp
            @foreach ($_SESSION['product'] as $smartphone)
            @if ($smartphone['cat_id']==$cat_product['id'] && $count < 9 ) @php $count++; @endphp <li>
                <a href="{{route('cat1.product',$smartphone->slug)}}" title="" class="thumb wp-img-50pt">
                    <img src="{{asset($smartphone['thumbnail'])}}">
                </a>
                <a href="{{route('cat1.product',$smartphone->slug)}}" title="" class="product-name truncate2">{{$smartphone['name']}}</a>
                <div class="price">
                    <span class="new">{{number_format($smartphone['price_current'], 0, "" ,"." )}}đ / {{$smartphone['unit']}}</span>
                </div>
                <div class="action clearfix">
                    <button title="Thêm giỏ hàng" data-id="{{$smartphone->id}}" class="add-cart fl-left">Thêm giỏ hàng</button>
                    <a href="{{url('thanh-toan')}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                </div>
                </li>
                @endif
                @endforeach
        </ul>
    </div>
    @endif
    @endforeach
</div>