
<li class="clearfix">
    <a href="{{route('cat1.product',$val->slug)}}" title="" class="thumb fl-left">
        <img src="{{asset($val['thumbnail'])}}" alt="" style="padding: 4px;">
    </a>
    <div class="info fl-right">
        <a href="{{route('cat1.product',$val->slug)}}" title="" class="product-name">{{$val['name']}}</a>
        <div class="price">
            <span class="new">{{number_format($val['price'], 0, "" ,"." )}}đ / {{$val->unitProduct->name}}</span>
            <!-- @if ($val['price_old'])
                <span class="old">{{number_format($val['price_old'], 0, "" ,"." )}}đ</span>
            @endif-->
        </div>
        <a href="{{route('order.buynow',$val['id'])}}" title="" class="buy-now">Mua ngay</a>
    </div>
</li>
