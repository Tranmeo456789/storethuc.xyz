@php
use App\Product;
$_SESSION['product']=Product::all();
@endphp
<div class="section-head">
    <h3 class="section-title">Sản phẩm nổi bật</h3>
    <span class="border-bottom-title "></span>
</div>
<div class="section-detail">
    <ul class="list-item">
        @foreach ($_SESSION['product_sellign'] as $item4)
        <li>
            <a href="{{route('cat1.product',$item4->slug)}}" title="" class="thumb wp-img-50pt">
                <img src="{{asset($item4->thumbnail)}}">
            </a>
            <a href="{{route('cat1.product',$item4->slug)}}" title="" class="product-name truncate2">{{$item4->name}}</a>
            <div class="price">
                <span class="new">{{number_format($item4['price_current'], 0, "" ,"." )}}đ / {{$item4['unit']}}</span>
                <!-- @if ($item4['price_old'])
                                                <span class="old">{{number_format($item4['price_old'], 0, "" ,"." )}}đ</span>
                                            @endif  -->
            </div>
            <div class="action clearfix">
                <button type="submit" title="" data-id="{{$item4->id}}" class="add-cart fl-left">Thêm giỏ hàng</button>
                <a href="{{url('thanh-toan')}}" title="" class="buy-now fl-right">Mua ngay</a>
            </div>
        </li>
        @endforeach
    </ul>
</div>