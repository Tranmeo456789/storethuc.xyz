@extends('layouts.app')

@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <div class="item">
                        <img src="{{asset('images/slider-01.png')}}" alt="">
                    </div>
                    <div class="item">
                        <img src="{{asset('images/slider-02.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title mt-0">Sản phẩm nổi bật</h3>
                    <span class="border-bottom-title "></span>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($_SESSION['product_sellign'] as $item4)
                        <li>
                            <a href="{{route('cat1.product',$item4->slug)}}" title="" class="thumb wp-img-50pt">
                                <img src="{{asset($item4->thumbnail)}}">
                            </a>
                            <a href="{{route('cat1.product',$item4->slug)}}" title="" class="product-name truncate2">{{$item4->name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($item4['price_current'], 0, "" ,"." )}}đ</span>
                            </div>
                            <div class="action clearfix">
                                <button title="Thêm giỏ hàng" data-id="{{$item4->id}}" class="add-cart fl-left">Thêm giỏ hàng</button>
                                <a href="{{url('thanh-toan')}}" title="" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                @foreach ($_SESSION['cat_product'] as $cat_product)
                @if ($cat_product['parent_id']==0)
                <div class="section-head">
                    <h3 class="section-title">{{$cat_product['title']}}</h3>
                    <span class="border-bottom-title "></span>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @php
                        $count =1;
                        @endphp
                        @foreach ($_SESSION['product'] as $smartphone)
                        @if ($smartphone['cat_id']==$cat_product['id'] && $count < 9) @php $count++; @endphp <li>
                            <a href="{{route('cat1.product',$smartphone->slug)}}" title="" class="thumb wp-img-50pt">
                                <img src="{{asset($smartphone['thumbnail'])}}">
                            </a>
                            <a href="{{route('cat1.product',$smartphone->slug)}}" title="" class="product-name truncate2">{{$smartphone['name']}}</a>
                            <div class="price">
                                <span class="new">{{number_format($smartphone['price_current'], 0, "" ,"." )}}đ</span>
                                @if ($smartphone['price_old'])
                                <span class="old">{{number_format($smartphone['price_old'], 0, "" ,"." )}}đ</span>
                                @endif
                            </div>
                            <div class="action clearfix">
                                <button title="Thêm giỏ hàng" data-id="{{$smartphone->id}}" class="add-cart fl-left">Thêm giỏ hàng</button>
                                <a href="{{url('thanh-toan')}}" title="" class="buy-now fl-right">Mua ngay</a>
                            </div>
                            </li>
                            @endif
                            @endforeach
                    </ul>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        @foreach ($_SESSION['cat_product'] as $item2)
                        @if ($item2['parent_id']==0)
                        <li>
                            <a href="{{route('cat0.product',$item2->slug)}}" title="" name='cat0_product' value='{{$item2['id']}}'>{{$item2['title']}}</a>
                            
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($_SESSION['product_sellign'] as $item1)
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="{{asset($item1['thumbnail'])}}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">{{$item1['name']}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item1['price_current'], 0, "" ,"." )}}đ</span>
                                    @if ($item1['price_old'])
                                    <span class="old">{{number_format($item1['price_old'], 0, "" ,"." )}}đ</span>
                                    @endif
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="{{asset('images/banner_doc3.png')}}" alt="">
                    </a>
                    <a href="" title="" class="thumb">
                        <img src="{{asset('images/banner.png')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection