@extends('layouts.app')

@section('content')
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            @include("client.product.child_detail.breadcrumb")
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <!-- chỗ để list hình ảnh  -->
                    <div class="thumb-wp fl-left">
                        <figure id="main-thumb" class="zoom" style="background-image:url({{asset($productCurrent['thumbnail'])}})" onmousemove="zoom(event)" ontouchmove="zoom(event)">
                            <img src="{{asset($productCurrent['thumbnail'])}}">
                        </figure>                   
                        <div id="list-thumb">                           
                            <div>                              
                                <div class="image-click" href="" data-image="" data-zoom-image="">
                                    <img style="padding: 2px" src="{{asset($productCurrent['thumbnail'])}}" />
                                </div>                              
                                <div class="text-center small" style="min-height: 100px"></div>                               
                            </div>                           
                        </div>
                    </div>
                    <!-- chỗ để list hình ảnh  -->
                    <div class="info fl-right">
                        <h3 class="product-name">{{$productCurrent['name']}}</h3>
                        <div class="desc">
                            {!!$productCurrent->describe!!}
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status {{$productCurrent['status_product']=='con_hang'?'active':''}}">{{$productCurrent['status_product']=='con_hang'?'Còn hàng':'Hết hàng'}}</span>
                        </div>
                        <span class="text-dark mr-5" style="font-size:20px;">Giá:</span><span class="price">{{number_format($productCurrent['price'], 0, "" ,"." )}}đ / {{$productCurrent->unitProduct->name}}</span>
                        <div id="num-order-wp" class="mt-3">
                            <form action="{{route('cart.add')}}" method="POST" id="detail-add-product">
                                @csrf
                                <div class="d-flex">
                                    <div class="d-inline-block mr-3 align-self-center"><span style="font-size:18px;padding-top: 5px">Số lượng:</span></div>
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="num_order" value="1" min="1" max="{{$productCurrent['inventory']}}" id="num-order" readonly>
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                    <input type="hidden" name="id_product" value="{{$productCurrent->id}}">
                                </div>
                                <div><input type="submit" title="Thêm giỏ hàng" value="Thêm giỏ hàng" class="add-cart3 mt-3" style="border:none;display: block"></div>
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
                    {!!$productCurrent->content!!}
                </div>
                <div class="bg-blur"></div>
                <div id="show-hidden-content" class="">Xem thêm</div>
            </div>
            <div class="section" id="same-category-wp">
                @include("client.product.child_detail.list_product_like_cat")
            </div>
        </div>
        <div class="sidebar fl-left">
            @include("client.block.sidebar")
        </div>
    </div>
</div>
@endsection