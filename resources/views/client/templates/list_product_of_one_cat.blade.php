@php
use App\Product_cat;
use App\Product;
$cat0_id_products=Product_cat::where('slug',$slug)->get();
$cat0_id_product=$cat0_id_products[0];
$_SESSION['product']=Product::all();
@endphp
<div class="section-head">
    <h3 class="section-title">{{$cat0_id_product['title']}}</h3>
    <span class="border-bottom-title "></span>
</div>
<div class="section-detail">
    <ul class="list-item clearfix">
        @php
        $count =1;
        @endphp
        @foreach ($_SESSION['product'] as $smartphone)
        @if ($smartphone['cat_id']==$cat0_id_product['id'])
        @php
        $count++;
        @endphp
        <li>
            <a href="{{route('cat1.product',$smartphone->slug)}}" title="" class="thumb wp-img-50pt">
                <img src="{{asset($smartphone['thumbnail'])}}">
            </a>
            <a href="{{route('cat1.product',$smartphone->slug)}}" title="" class="product-name truncate2">{{$smartphone['name']}}</a>
            <div class="price">
                <span class="new">{{number_format($smartphone['price_current'], 0, "" ,"." )}}đ / {{$smartphone['unit']}}</span>
            </div>
            <div class="action clearfix">
                <button title="Thêm giỏ hàng" data-id="{{$smartphone->id}}" class="add-cart fl-left">Thêm giỏ hàng</button>
                <a href="{{url('thanh-toan')}}" title="" class="buy-now fl-right">Mua ngay</a>
            </div>
        </li>
        @endif
        @endforeach
    </ul>
</div>