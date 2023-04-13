<div id="btn-cart" class="btn-cart">
    <a href="{{url('show/cart')}}" class="text-light"><img src="{{asset('images/cart.png')}}" alt="">
        @if (Cart::count() >0)
        <span id="num" class="num-cart">{{Cart::count()}}</span>
        @endif
    </a>
</div>