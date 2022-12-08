@php
use App\Model\CatProductModel;
$catId=$productCurrent['cat_id'];
$catParentProduct=(new CatProductModel)->getItem(['id'=>$catId],['task'=>'get-item']);
@endphp
<div class="secion-detail">
    <ul class="list-item clearfix">
        @if (Auth::check())
        <li><a href="{{url('/home')}}" title="">Trang chủ</a></li>
        @else
        <li><a href="{{url('/')}}" title="">Trang chủ</a></li>
        @endif
        <li>
            <a href="{{url('san-pham')}}" title="">Sản phẩm</a>
        </li>   
        <li>
            <a href="{{route('cat0.product',$catParentProduct->slug)}}" title="">{{$catParentProduct['name']}}</a>
        </li>
    </ul>
</div>