@php
use App\Product_cat;
$_SESSION['cat_product']=Product_cat::all();
@endphp
<a href="{{route('home')}}" title="" class="logo">STORE</a>
<div id="menu-respon-wp">
    <ul class="" id="main-menu-respon">
        <li>
            <a href="{{route('home')}}" title>Trang chủ</a>
        </li>

        <li>
            @foreach ($_SESSION['cat_product'] as $item2)
            @if ($item2['parent_id']==0)
        <li>
            <a href="{{route('cat0.product',$item2->slug)}}" title="" name='cat0_product' value="{{$item2['id']}}">{{$item2['title']}}</a>
        </li>
        @endif
        @endforeach
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