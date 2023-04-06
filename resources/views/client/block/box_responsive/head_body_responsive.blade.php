<div class="wp-inner">
    <div class="py-2 d-flex justify-content-between">
        <div id="btnmenu-resp"><img src="{{asset('images/nb3.png')}}" alt=""></div>
        <div id="logo">
            @if (Auth::check())
            <a href="{{url('/home')}}"><img src="{{asset('images/logo.png')}}" /></a>
            @else
            <a href="{{url('/')}}"><img src="{{asset('images/logo.png')}}" /></a>
            @endif
        </div>
        <div id="wp-cart-respon">
            <div id="btn-cart">
                <a href="{{url('show/cart')}}" class="text-light"><img src="{{asset('images/cart.png')}}" alt="">
                    @if (Cart::count() >0)
                    <span id="num">{{Cart::count()}}</span>
                    @endif
                </a>
            </div>
        </div>
    </div>
    <div class="pb-2">
        <div class="wp-form-search" id="search-wp-responsive">
            <form method="GET" action="{{url('tim-kiem')}}" class="d-flex justify-content-center">
                <div class="wp-input-search">
                    <div class="input-search">
                        <input type="search" name="key" value="{{request()->input('key')}}" id="s" data-href="{{route('searchProductAjax')}}" placeholder="Nhập từ khóa tìm kiếm tại đây!" autocomplete="off">
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
</div>