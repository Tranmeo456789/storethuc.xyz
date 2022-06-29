@extends('layouts.app')

@section('content')

<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    @foreach ($_SESSION['slider'] as $slider)
                    <div class="item">
                        <img src="{{asset($slider->image)}}" alt="" class="img-fluid" style="">
                    </div>
                    @endforeach                   
                   </div>
            </div>
            
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-1.png')}}">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-2.png')}}">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-3.png')}}">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-4.png')}}">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-5.png')}}">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                    <span class="border-bottom-title "></span>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($_SESSION['product_sellign'] as $item4)
                            <li>
                                    <a href="{{route('cat1.product',$item4->slug)}}" title="" class="thumb">
                                        <img src="{{asset($item4->thumbnail)}}">
                                    </a>
                                    <a href="{{route('cat1.product',$item4->slug)}}" title="" class="product-name">{{$item4->name}}</a>
                                    <div class="price">
                                        <span class="new">{{number_format($item4['price_current'], 0, "" ,"." )}}đ</span>
                                            @if ($item4['price_old'])
                                                <span class="old">{{number_format($item4['price_old'], 0, "" ,"." )}}đ</span>
                                            @endif 
                                    </div>
                                    <div class="action clearfix">
                                        <button type="submit" title="" data-id="{{$item4->id}}" class="add-cart fl-left">Thêm giỏ hàng</button>
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
                                    @if ($smartphone['cat_id']==$cat_product['id'] && $count<9)
                                        @php
                                            $count++;
                                        @endphp 
                                            <li>
                                                <a href="{{route('cat1.product',$smartphone->slug)}}" title="" class="thumb">
                                                    <img src="{{asset($smartphone['thumbnail'])}}">
                                                </a>
                                                <a href="{{route('cat1.product',$smartphone->slug)}}" title="" class="product-name">{{$smartphone['name']}}</a>
                                                <div class="price">
                                                    <span class="new">{{number_format($smartphone['price_current'], 0, "" ,"." )}}đ</span>
                                                    @if ($smartphone['price_old'])
                                                        <span class="old">{{number_format($smartphone['price_old'], 0, "" ,"." )}}đ</span>
                                                    @endif                                                                       
                                                </div>
                                                <div class="action clearfix">
                                                    <button href="" title="Thêm giỏ hàng" data-id="{{$smartphone->id}}" class="add-cart fl-left">Thêm giỏ hàng</button>
                                                    <a href="{{url('thanh-toan')}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
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
                                <a href="{{route('cat0.product',$item2->slug)}}" title="" name='cat0_product' value='{{$item2['id']}}' >{{$item2['title']}}</a>
                                <ul class="sub-menu">
                                    @foreach ($_SESSION['cat_product_child'] as $item3)
                                        @if ($item3['parent_id']==$item2['id'])
                                        <li>
                                            <a href="{{route('cat1.product',$item3->slug)}}" title="">{{$item3['title']}}</a>
                                        </li> 
                                        @endif
                                    @endforeach                                   
                                </ul>
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
                                <a href="{{route('cat1.product',$item1->slug)}}" title="" class="thumb fl-left">
                                    <img src="{{asset($item1['thumbnail'])}}" alt="" style="padding: 4px;">
                                </a>
                                <div class="info fl-right">
                                    <a href="{{route('cat1.product',$item1->slug)}}" title="" class="product-name">{{$item1['name']}}</a>
                                    <div class="price">
                                        <span class="new">{{number_format($item1['price_current'], 0, "" ,"." )}}đ</span>
                                        @if ($item1['price_old'])
                                            <span class="old">{{number_format($item1['price_old'], 0, "" ,"." )}}đ</span>
                                        @endif                                                                       
                                    </div>
                                    <a href="{{url('thanh-toan')}}" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach   
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="{{asset('images/banner.png')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
