<li>
    <a href="{{route('frontend.product.detail',$val->slug)}}">
        <div class="d-flex align-items-center">
            <div class="wp-30">
                <div class="thumb">
                    <img src="{{asset($val['thumbnail'])}}" alt="">
                </div>
            </div>
            <div class="info">
                <p class="product-name">{{$val['name']}}</p>
                <div class="price">
                    <span class="new">
                        {{number_format($val['price'], 0, "" ,"." )}}
                        <span class="dmini">đ</span>
                    </span>
                    <span class="text-danger" style="font-size: 18px;">/</span>
                    <span class="unit-in-content">{{$val->unitProduct->name}}</span>
                    <!-- @if ($val['price_old'])
                <span class="old">{{number_format($val['price_old'], 0, "" ,"." )}}đ</span>
            @endif-->
                </div>
                <!-- <a href="{{route('order.buynow',$val['id'])}}" title="" class="buy-now">Mua ngay</a> -->
            </div>
        </div>

    </a>
</li>