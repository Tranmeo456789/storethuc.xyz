<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cửa hàng anh thức</title>
    <link href="{{asset('css/bootstrap/bootstrap-theme.min.css')}}?t=@php echo time() @endphp" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/bootstrap/bootstrap.min.css')}}?t=@php echo time() @endphp" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/reset.css')}}?t=@php echo time() @endphp" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/carousel/owl.theme.css')}}?t=@php echo time() @endphp" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/carousel/owl.carousel.css')}}?t=@php echo time() @endphp" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}?t=@php echo time() @endphp" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/import.css')}}?t=@php echo time() @endphp" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/sweetalert.css')}}?t=@php echo time() @endphp" rel="stylesheet" type="text/css">
    <link href="{{asset('css/responsive.css')}}?t=@php echo time() @endphp" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <script src="https://connect.facebook.net/vi_VN/sdk.js?hash=ce25f2a893e29e713de6a0e16d3a901f" async="" crossorigin="anonymous"></script>
    <script id="facebook-jssdk" src="//connect.facebook.net/vi_VN/sdk.js#xfbml=1&amp;version=v2.8&amp;appId=849340975164592"></script>
    <script src="{{asset('js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/elevatezoom-master/jquery.elevatezoom.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/carousel/owl.carousel.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/main.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  --}}
</head>

<body>
    <div id="app">
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <!-- <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a> -->
                            <div id="main-menu-wp" class="fl-left">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        @if (Auth::check())
                                        <a href="{{url('/home')}}" title="">Trang chủ</a>
                                        @else
                                        <a href="{{url('/')}}" title="">Trang chủ</a>
                                        @endif
                                    </li>
                                    <li>
                                        <a href="{{url('san-pham')}}" title="">Sản phẩm</a>
                                    </li>
                                    <li>
                                        <a href="{{route('pages','tin-tuc')}}" title="">Tin tức</a>
                                    </li>
                                    <li>
                                        <a href="{{route('pages',$page_introduce->slug)}}" title="">Giới thiệu</a>
                                    </li>

                                    <li>
                                        <a href="{{route('pages',$page_contact->slug)}}" title="">Liên hệ</a>
                                    </li>
                                </ul>
                            </div>
                            <div id="main-menu2-wp" class="fl-right">
                                <ul id="main-menu" class="clearfix">
                                    @if (Route::has('login'))
                                    <div class="top-right links">
                                        @auth
                                        <li>
                                            <div class="btn-group user-login">
                                                <div type="button" class="btn dropdown-toggle text-light " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <!-- <span class="border rounded-circle p-1 text-light" ><i class="fa fa-user" aria-hidden="true"></i></span> -->
                                                    {{ Auth::user()->name }}
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{route('backend.dashboard')}}">Tài khoản</a>
                                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                        @else
                                        <li><a href="{{ route('login') }}">{{__('Log in')}}</a></li>
                                        @if (Route::has('register'))
                                        <!-- <li><a href="{{ route('register') }}">{{__('Register')}}</a></li> -->
                                        @endif
                                        @endauth
                                    </div>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            @if (Auth::check())
                            <a href="{{url('/home')}}" title="" id="logo" class="fl-left"><img src="{{asset('images/logokieutrang.png')}}" /></a>
                            @else
                            <a href="{{url('/')}}" title="" id="logo" class="fl-left"><img src="{{asset('images/logokieutrang.png')}}" /></a>
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
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">Tư vấn</span>
                                    <span class="phone">0983.195.167</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="{{url('show/cart')}}" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                    <div class="wp-cart-respon">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        @if (Cart::count() >0)
                                            <span id="num1" class="num-cart-res">{{Cart::count()}}</span>
                                        @endif
                                    </div>
                                </a>
                                <div id="cart-wp" class="fl-right">
                                    <div id="btn-cart">
                                        <a href="{{url('show/cart')}}" class="text-light"><i id="trash-header" class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            @if (Cart::count() >0)
                                            <span id="num">{{Cart::count()}}</span>

                                            @endif
                                        </a>
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
                                            @if ($temp < 3) 
                                            <li class="clearfix">
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
                    </div>
                </div>
                <main class="py-4">
                    @yield('content')
                </main>

                <div id="footer-wp">
                    <div id="foot-body">
                        <div class="wp-inner clearfix">
                            <div class="block" id="info-company">
                                <h3 class="title">STORE THUC</h3>
                                <p class="desc">Cửa hàng luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng, chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                                <div id="payment">
                                    <div class="thumb">
                                        <img src="{{asset('images/img-foot.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="block menu-ft" id="info-shop">
                                <h3 class="title">Thông tin cửa hàng</h3>
                                <ul class="list-item">
                                    <li>
                                        <p>106 - Nguyễn Chí Thanh - Cam Ranh - Khánh Hòa</p>
                                    </li>
                                    <li>
                                        <p>0983.195.167</p>
                                    </li>
                                    <li>
                                        <p>storethuc@gmail.com</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="block menu-ft policy" id="info-shop">
                                <h3 class="title">Chính sách mua hàng</h3>
                                <ul class="list-item">
                                    <li>
                                        <a href="" title="">Về chúng tôi</a>
                                    </li>
                                    <li>
                                        <a href="" title="">Chính sách đổi trả</a>
                                    </li>
                                    <li>
                                        <a href="" title="">Chính sách hội viện</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="block" id="newfeed">
                                <h3 class="title">Bảng tin</h3>
                                <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                                <div id="form-reg">
                                  
                                        <input type="email" name="email" id="email" placeholder="Nhập email tại đây">
                                        <button type="submit" id="sm-reg">Đăng ký</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="foot-bot">
                        <div class="wp-inner">
                            <p id="copyright">
                                Copyright 2022 © CHCT; all rights reserved. Powered by CHCT
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu-respon">
                <a href="{{route('home')}}" title="" class="logo">STORE</a>
                <div id="menu-respon-wp">
                    <ul class="" id="main-menu-respon">
                        <li>
                            <a href="{{route('home')}}" title>Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title>Yến</a>                         
                        </li>                        
                        <li>
                            <a href="" title>Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="btn-top"><img src="{{asset('images/icon-to-top.png')}}" alt="" /></div>
            <div id="fb-root"></div>

        </div>

        <script src="{{asset('js/sweetalert.min.js')}}"></script>
        <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>

        <script>
            //update cart ajax
            $('.minus1').click(function() {
                if (Number($(this).next('.num-order').val()) > 1) {
                    var num_per_product = Number($(this).next('.num-order').val()) - 1;
                    $(this).next('.num-order').val(num_per_product);
                    var qty = $(this).next('.num-order').val();
                    var id = $(this).next('.num-order').attr("data-id");
                    var rowId = $(this).next('.num-order').attr("data-rowId");
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{url('cart/updateCartAjax')}}",
                        method: "POST",
                        dataType: 'json',
                        data: {
                            qty: qty,
                            id: id,
                            rowId: rowId,
                            _token: _token
                        },
                        success: function(data) {
                            $(".sub-total" + id).text(data.sub_total);
                            $("#num").text(data.num_order);
                            $("#num1").text(data.num_order);
                            $("#total-cart").text(data.total_cart);
                            $('#dropdown').html(data.list_cart);
                        },
                    });
                }

            });
            $('.plus1').click(function() {
                if (Number($(this).prev('.num-order').val()) < 10) {
                    var num_per_product = Number($(this).prev('.num-order').val()) + 1;
                    $(this).prev('.num-order').val(num_per_product);
                    var qty = $(this).prev('.num-order').val();
                    var id = $(this).prev('.num-order').attr("data-id");
                    var rowId = $(this).prev('.num-order').attr("data-rowId");
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{url('cart/updateCartAjax')}}",
                        method: "POST",
                        dataType: 'json',
                        data: {
                            qty: qty,
                            id: id,
                            rowId: rowId,
                            _token: _token
                        },
                        success: function(data) {
                            $(".sub-total" + id).text(data.sub_total);
                            $("#num").text(data.num_order);
                            $("#num1").text(data.num_order);
                            $("#total-cart").text(data.total_cart);
                            $('#dropdown').html(data.list_cart);
                        },
                    });
                }
            });
            $('.num-order').change(function() {
                var qty = $(this).val();
                var id = $(this).attr("data-id");
                var rowId = $(this).attr("data-rowId");
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('cart/updateCartAjax')}}",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        qty: qty,
                        id: id,
                        rowId: rowId,
                        _token: _token
                    },
                    success: function(data) {
                        $(".sub-total" + id).text(data.sub_total);
                        $("#num").text(data.num_order);
                        $("#total-cart").text(data.total_cart);
                        $('#dropdown').html(data.list_cart);
                    },
                });
            });
            $('.add-cart').click(function() {
                var id = $(this).attr("data-id");
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('saveAjax/cart')}}",
                    method: "GET",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(data) {

                        swal({
                                title: "Thêm sản phẩm thành công!",
                                type: "success",
                                text: "Bạn có muốn đi đến giỏ hàng?",
                                showCancelButton: true,
                                confirmButtonClass: "btn-primary",
                                confirmButtonText: "Yes",
                                cancelButtonClass: "btn-warning",
                                cancelButtonText: "No",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            },
                            function(isConfirm) {
                                var id = $(this).attr("data-id");
                                if (isConfirm) {
                                    window.location.href = "{{url('show/cart')}}";
                                } else {
                                    window.location.reload();
                                }
                            });
                    },
                    // error: function(xhr, ajaxOptions, thrownError) {
                    //     alert(xhr.status);
                    //     alert(thrownError);
                    // }

                });

            });
        </script>
</body>

</html>