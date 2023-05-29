@php
use App\Model\CatProductModel;
use App\Model\PageModel;

$listCatProduct=(new CatProductModel)->listItems(null,['task'=>'list-items-front-end']);
$pages=PageModel::all();

@endphp
<div class="tlogo-menu position-relative">
    <div class="d-flex justify-content-start align-items-center width-100">
        <img src="{{asset('images/logo-moi.png')}}">
    </div>
    <div class="closem" id="closem"><img src="{{asset('images/closem.png')}}"></div>
</div>
<div class="body-responhoder">
    <a href="{{route('order.view_search_phone_order')}}">
        <div class="container-menures d-flex">
            <div class="width-20 img-center"><img src="{{asset('images/news1.png')}}"></div>
            <h2>Tra cứu lịch sử đơn hàng</h2>
        </div>
    </a>
</div>
<div class="bg-white container-menures">
    <h3>
        <div class=""><a href="{{url('/')}}">Trang chủ</a></div>
    </h3>
    <ul class="pl-2">
        <li>
            <div class="position-relative parentsmenu">
                <div class=" pr-4">
                    <a href="{{url('san-pham')}}">Sản phẩm</a>
                </div>
                <div class="icon-arrow"><img src="{{asset('images/arrowd.png')}}" alt=""></div>
                <div class="submenu1res">
                    <ul>
                        @foreach ($listCatProduct as $item2)
                        @if ($item2['parent_id']==1)
                        <li>
                            <a href="{{route('cat0.product',$item2->slug)}}" title="" name='cat0_product' value="{{$item2['id']}}">{{$item2['name']}}</a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </li>
        <div class=" pr-4">
            <li>
                <a href="{{route('pages','tin-tuc')}}" title="">Tin tức</a>
            </li>
        </div>
        @foreach($pages as $page)
        <div class=" pr-4">
            <li>
                <a href="{{route('pages',$page->slug)}}" title="">{{$page->name}}</a>
            </li>
        </div>
        @endforeach
        <li>
            <div class="position-relative parentsmenu">
                <div class=" pr-4">
                    <ul id="main-menu" class="clearfix">
                        @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                            <li>
                                <div class="btn-group user-login">
                                    <div type="button" class="btn dropdown-toggle text-info p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('dashboard')}}">Tài khoản</a>
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
        </li>
    </ul>
</div>