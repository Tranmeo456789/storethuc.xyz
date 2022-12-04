@extends('layouts.app')

@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            @if ($product_searchs->count()>0)
            <div class="section" id="list-product-wp">
                <p style="font-size:18px">Tìm thấy <span class="font-weight-bold">{{$product_searchs->count()}}</span> kết quả</p>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($product_searchs as $smartphone)
                        <li>
                            <a href="{{route('cat1.product',$smartphone->slug)}}" title="" class="thumb wp-img-50pt">
                                <img src="{{asset($smartphone['thumbnail'])}}">
                            </a>
                            <a href="{{route('cat1.product',$smartphone->slug)}}" title="" class="product-name truncate2">{{$smartphone['name']}}</a>
                            <div class="price">
                                <span class="new">{{number_format($smartphone['price_current'], 0, "" ,"." )}}đ / {{$smartphone['unit']}}</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @else
            <p style="font-size:18px">Rất tiếc, không tìm thấy kết quả nào phù hợp với từ khóa <span class="font-weight-bold">"{{request()->input('key')}}"</span></p>
            <div class="mt-3 text-start">
                <div>
                    <p class="font-weight-bold mb-0">Để tìm được kết quả chính xác hơn, bạn vui lòng:</p>
                    <p class="mb-0"><small>* Kiểm tra lỗi chính tả của từ khóa đã nhập</small></p>
                    <p class="mb-0"><small>* Thử lại bằng từ khóa khác</small></p>
                    <p class="mb-0"><small>* Thử lại bằng những từ khóa ngắn gọn hơn</small></p>
                    <p class="mb-0"><small>* Thử lại bằng những từ khóa tổng quát hơn</small></p>
                </div>
            </div>
            @endif
        </div>
        <div class="sidebar fl-left">
            @include("client.block.sidebar")
        </div>
    </div>
</div>
@endsection