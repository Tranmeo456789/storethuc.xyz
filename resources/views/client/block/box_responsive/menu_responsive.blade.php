@php
use App\Model\CatProductModel;
use App\Model\PageModel;

$listCatProduct=(new CatProductModel)->listItems(null,['task'=>'list-items-front-end']);
$pages=PageModel::all();

@endphp
<a href="{{route('home')}}" title="" class="logo">STORE</a>
<div id="menu-respon-wp">
    <ul class="" id="main-menu-respon">
        <li>
            <a href="{{route('home')}}" title>Trang chủ</a>
        </li>

        <li>
            @foreach ($listCatProduct as $item2)
            @if ($item2['parent_id']==1)
        <li>
            <a href="{{route('cat0.product',$item2->slug)}}" title="" name='cat0_product' value="{{$item2['id']}}">{{$item2['name']}}</a>
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
        @foreach($pages as $page)
            <li>
                <a href="{{route('pages',$page->slug)}}" title="">{{$page->name}}</a>
            </li>
        @endforeach
    </ul>
</div>