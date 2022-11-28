@extends('layouts.app')

@section('content')
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
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
                    @foreach ($_SESSION['cat_product'] as $item_detail)
                        @if($product['cat_id']==$item_detail['id'])
                            <li>
                                <a href="{{route('cat0.product',$item_detail->slug)}}" title="">{{$item_detail['title']}}</a>
                            </li>
                        @endif         
                    @endforeach
                    @foreach ($_SESSION['cat_product_child'] as $item_detail1)
                        @if ($product['cat_id_child']==$item_detail1['id'])
                            <li>
                                <a href="{{route('cat1.product',$item_detail1->slug)}}" title="">{{$item_detail1['title']}}</a>
                            </li> 
                        @endif
                    @endforeach 
                   
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    @if($image_products)
                    <div class="thumb-wp fl-left">               
                        @if ($image_products[0]['image'])
                            <figure id="main-thumb" class="zoom" style="background-image:url({{asset($image_products[0]['image'])}})" onmousemove="zoom(event)" ontouchmove="zoom(event)">
                                <img  src="{{asset($image_products[0]['image'])}}">
                            </figure>
                        @endif  
                        <div id="list-thumb">    
                                @foreach ($image_products as $image_product)
                                <div style="">
                                    @if ($image_product['image'])
                                        <div class="image-click" href="" data-image="" data-zoom-image="">
                                            <img  style="padding: 2px" src="{{asset($image_product['image'])}}" />
                                        </div>
                                    @endif               
                                    @if ($image_product->name_color)
                                    <div class="text-center small" style="min-height: 100px">{{$image_product->name_color}}</div>
                                    @endif                
                                </div>            
                                @endforeach           
                        </div>
                    </div>
                    @if ($image_products[0]['image'])
                    <div class="thumb-respon-wp fl-left">
                        <img src="{{asset($image_products[0]['image'])}}" alt="">
                    </div>
                    @endif      
                    @endif
                    
                    <div class="info fl-right">
                        <h3 class="product-name">{{$product['name']}}</h3>
                        <div class="desc">
                           {!!$product->describe!!}
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">{{$product['status']}}</span>
                        </div>
                        <span class="text-dark mr-5" style="font-size:20px;">Giá:</span><span class="price">{{number_format($product['price_current'], 0, "" ,"." )}}đ</span>
                            <div id="num-order-wp">
                                <form action="{{route('cart.add')}}" method="POST" id="detail-add-product" >
                                    @csrf
                                    <div class="d-inline-block mr-3"><span style="font-size:18px;padding-top: 5px">Số lượng:</span></div>
                                    {{-- <input type="hidden" name="_token" value="">           --}}
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="num_order" value="1" min="1" max="10" id="num-order" readonly>
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                    <input type="hidden" name="id_product" value="{{$product->id}}">
                                    <input type="submit" title="Thêm giỏ hàng" value="Thêm giỏ hàng" class="add-cart3 mt-3" style="border:none;display: block">
                                </form>
                            </div>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    {!!$product->content!!}
                </div>
                <div class="bg-blur"></div>
                <div id="show-hidden-content" class="">Xem thêm</div>
            </div>
            <div class="section" id="same-category-wp">
                @if ($product_like_cat->count()>0)
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        
                        @foreach ($product_like_cat as $item5)
                            <li>
                                @if ($item5->thumbnail)
                                <a href="{{route('cat1.product',$item5->slug)}}" title="" class="thumb">
                                    <img src="{{asset($item5->thumbnail)}}">
                                </a>
                                @endif
                                <a href="{{route('cat1.product',$item5->slug)}}" title="" class="product-name">{{$item5->name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item5['price_current'], 0, "" ,"." )}}đ</span>
                                    @if ($item5->price_old)
                                        <span class="old">{{number_format($item5['price_old'], 0, "" ,"." )}}đ</span>
                                    @endif                            
                                </div>
                                <div class="action clearfix">
                                    <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach                            
                    </ul>
                </div>
                @endif
                
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