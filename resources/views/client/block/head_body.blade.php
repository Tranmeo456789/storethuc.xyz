<div class="wp-inner clearfix">
    @if (Auth::check())
    <a href="{{url('/home')}}" title="" id="logo" class="fl-left"><img src="{{asset('images/logo.png')}}" /></a>
    @else
    <a href="{{url('/')}}" title="" id="logo" class="fl-left"><img src="{{asset('images/logo.png')}}" /></a>
    @endif
    <div id="search-wp" class="fl-left">
        <div class="wp-form-search">
            <form method="GET" action="{{url('tim-kiem')}}" class="d-flex justify-content-center">
                <div class="wp-input-search">
                    <div class="input-search">
                        <input type="text" name="key" value="{{request()->input('key')}}" id="s" data-href="{{route('searchProductAjax')}}" placeholder="Nhập từ khóa tìm kiếm tại đây!" autocomplete="off">
                    </div>
                    <button type="submit" name="" id="sm-s"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <div class="search-result">
                        <ul class="suggest-search mb-0">
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="action-wp" class="fl-right">
        <!-- <a id="advisory-wp" class="fl-left" href="tel:{{$phoneAdmin}}">
            <span class="title">Tư vấn</span>
            <span class="phone">{{$phoneAdmin}}</span>
        </a> -->
        <a id="advisory-wp" class="fl-left" href="{{route('order.view_search_phone_order')}}">
            <span class="phone">Tra cứu</span>
            <span class="phone">đơn hàng</span>
        </a>
        <div id="cart-wp" class="fl-right">
            <div class="wp-icon-cart">
                @include("client.partial.icon_cart")
            </div>
            @if (Cart::count() >0)
            <div id="dropdown">
                <p class="desc">Có <span>{{Cart::count()}} sản phẩm</span> trong giỏ hàng</p>
                <ul class="list-cart">
                    @php
                    $temp=0;
                    @endphp
                    @foreach (Cart::content() as $row1)
                    @php
                    $temp++;
                    @endphp
                    @if ($temp < 3) <li class="clearfix">
                        <a href="" title="" class="thumb fl-left">
                            <img src="{{asset($row1->options->thumbnail)}}" alt="">
                        </a>
                        <div class="info fl-right">
                            <a href="{{route('cat1.product',$row1->options->slug)}}" title="" class="product-name truncate2">{{$row1->name}}</a>
                            <p class="price mb-0">{{ number_format($row1->price, 0, ',', '.') }}đ / {{$row1->options->unit}}</p>
                            <p class="qty mb-0">Số lượng: <span>{{$row1->qty}}</span></p>
                        </div>
                        </li>
                        @endif
                        @endforeach
                </ul>
                <div class="total-price clearfix">
                    <p class="title fl-left mb-0">Tổng:</p>
                    <p class="price fl-right mb-0">{{ Cart::total() }} <span class="text-lowercase">đ</span></p>
                </div>
                <div class="action-cart clearfix">
                    <a href="{{url('show/cart')}}" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                    <a href="?page=checkout" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
