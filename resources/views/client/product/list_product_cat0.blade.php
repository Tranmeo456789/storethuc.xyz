@extends('layouts.app')

@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <!-- <div class="section" id="slider-wp">
                <div class="section-detail">
                    <div class="item">
                        <img src="{{asset('uploads/images/product/banner1.png')}}" alt="">
                    </div>
                    <div class="item">
                        <img src="{{asset('uploads/images/product/banner2.png')}}" alt="">
                    </div>
                   
                </div>
            </div> -->
            <div class="section mt-0" id="support-wp">
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
                            <p class="desc">0983.195.167</p>
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
                        @if ($product_sellign_like_cats->count() > 0)
                        @foreach ($product_sellign_like_cats as $product_sellign_like_cat)
                        <li>
                            <a href="{{route('cat1.product',$product_sellign_like_cat->slug)}}" title="" class="thumb wp-img-50pt">
                                <img src="{{asset($product_sellign_like_cat->thumbnail)}}">
                            </a>
                            <a href="{{route('cat1.product',$product_sellign_like_cat->slug)}}" title="" class="product-name truncate2">{{$product_sellign_like_cat->name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($product_sellign_like_cat['price_current'], 0, "" ,"." )}}đ / {{$product_sellign_like_cat['unit']}}</span>
                                <!-- @if ($product_sellign_like_cat['price_old'])
                                <span class="old">{{number_format($product_sellign_like_cat['price_old'], 0, "" ,"." )}}đ</span>
                                @endif -->
                                
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>  
                        @endforeach
                        
                        @endif
                                            
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">{{$cat0_id_product['title']}}</h3>
                    <span class="border-bottom-title "></span>
                </div>
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                @php
                                    $count =1;
                                @endphp
                               @foreach ($_SESSION['product'] as $smartphone)                                   
                                    @if ($smartphone['cat_id']==$cat0_id_product['id'])
                                        @php
                                            $count++;
                                        @endphp 
                                            <li>
                                                <a href="{{route('cat1.product',$smartphone->slug)}}" title="" class="thumb wp-img-50pt">
                                                    <img src="{{asset($smartphone['thumbnail'])}}">
                                                </a>
                                                <a href="{{route('cat1.product',$smartphone->slug)}}" title="" class="product-name truncate2">{{$smartphone['name']}}</a>
                                                <div class="price">
                                                    <span class="new">{{number_format($smartphone['price_current'], 0, "" ,"." )}}đ / {{$smartphone['unit']}}</span>
                                                    <!-- @if ($smartphone['price_old'])
                                                        <span class="old">{{number_format($smartphone['price_old'], 0, "" ,"." )}}đ</span>
                                                    @endif                                                                        -->
                                                </div>
                                                <div class="action clearfix">
                                                    <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                                    <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                                </div>
                                            </li>
                                        @endif   
                                @endforeach                                                           
                            </ul>
                        </div>
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
                                <!-- <ul class="sub-menu">
                                    @foreach ($_SESSION['cat_product_child'] as $item3)
                                        @if ($item3['parent_id']==$item2['id'])
                                        <li>
                                            <a href="{{route('cat1.product',$item3->slug)}}" title="">{{$item3['title']}}</a>
                                        </li> 
                                        @endif
                                    @endforeach                                   
                                </ul> -->
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
                                    <img src="{{asset($item1['thumbnail'])}}" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="{{route('cat1.product',$item1->slug)}}" title="" class="product-name">{{$item1['name']}}</a>
                                    <div class="price">
                                        <span class="new">{{number_format($item1['price_current'], 0, "" ,"." )}}đ/{{$item1['unit']}}</span>                                                                      
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
