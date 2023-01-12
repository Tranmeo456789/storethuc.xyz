@php
use App\Model\CatProductModel;

use App\Model\PageModel;

$listCatProduct=(new CatProductModel)->listItems(null,['task'=>'list-items-front-end']);
$pages=PageModel::all();

@endphp
<div class="wp-inner clearfix">
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
                <a href="{{route('posts')}}" title="">Tin tức</a>
            </li>
            @foreach($pages as $page)
                <li>
                    <a href="{{route('pages',$page->slug)}}" title="">{{$page->name}}</a>
                </li>
            @endforeach
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