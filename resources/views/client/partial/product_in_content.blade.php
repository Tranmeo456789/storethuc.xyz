<li>
    <a href="{{route('frontend.product.detail',$val->slug)}}" title="" class="thumb wp-img-50pt">
        <img src="{{asset($val['thumbnail'])}}">
    </a>
    <a href="{{route('frontend.product.detail',$val->slug)}}" title="" class="product-name truncate2">{{$val['name']}}</a>
    <div class="price">
        <span class="new">{{number_format($val['price'], 0, "" ,"." )}}đ / {{$val->unitProduct->name}}</span>
    </div>
    <div class="action clearfix">
        <button title="Thêm giỏ hàng" data-id="{{$val->id}}" class="add-cart fl-left">Thêm giỏ hàng</button>
        <a href="{{route('order.buynow',$val['id'])}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
    </div>
</li>