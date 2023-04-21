<li>
    <div class="position-relative" style="height:100%">
        <a href="{{route('frontend.product.detail',$val->slug)}}" class="wp-effect-cart">
            <div class="heigth-img-content">
                <div class="thumb img-center-100">
                    <img src="{{asset($val['thumbnail'])}}">
                </div>
            </div>        
            <div class="product-name">
                <div class="py-2">
                    <p class="truncate2">{{$val['name']}}</p>
                </div>
            </div>
            <div class="price">
                <span class="new">
                    {{number_format($val['price'], 0, "" ,"." )}}
                    <span class="dmini">đ</span>
                </span>
                <span class="text-danger" style="font-size: 18px;">/</span>
                <span class="unit-in-content">{{$val->unitProduct->name}}</span>
            </div>
            <div class="action d-flex justify-content-center">
            <button title="Thêm giỏ hàng" data-id="{{$val->id}}" data-url="{{route('cart.saveAjax')}}" data-urlShowCart="{{route('cart.show')}}" class="add-cart">Thêm giỏ hàng</button>
                <!-- <a href="{{route('order.buynow',$val['id'])}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a> -->
            </div>
            @if(isset($val['promotion']))
                @if($val['promotion']>0)
                <div class="C+nQBU uOQMgX _43c7xw">
                    <div class="m2nQX2">
                        <div class="WsnY7I">
                            <span class="percent">{{$val['promotion']}}%</span>
                            <span class="bsTk4f">giảm</span>
                        </div>
                    </div>
                </div>
                @endif
            @endif
        </a>
    </div>
</li>