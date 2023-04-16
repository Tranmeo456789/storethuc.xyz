@extends('layouts.app')
@section('content')
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        @if (Auth::check())
                        <a href="{{url('/home')}}" title="">Trang chủ</a>
                        @else
                        <a href="{{url('/')}}" title="">Trang chủ</a>
                        @endif
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form action="{{route('cart.update')}}" method="POST">
        @csrf
        @if (Cart::count() >0)
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="info-cart-wp">
                <!-- <div class="section-detail table-responsive">
                <table class="table">
                    <thead>
                        <tr>                           
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            
                            <td>Số lượng</td>
                            <td >Thành tiền</td>
                            <td>Tác vụ</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                                $temp = 0;
                        @endphp
                        @foreach (Cart::content() as $row)
                        <tr>                                                     
                            <td>
                                <a href="" title="" class="thumb">
                                    <img src="{{asset($row->options->thumbnail)}}" alt="">
                                </a>
                            </td>
                            <td>
                                <a href="" title="" class="name-product truncate2">{{$row->name}}</a>
                                <p class="unit-cart"><span class="font-weight-bold">Đơn giá: </span><span class="text-danger">{{ number_format($row->price, 0, ',', '.') }}đ / {{$row->options->unit}}</span></p>
                            </td>
                            <td>
                                <span title="" class="minus1"><i class="fa fa-minus"></i></span>
                                <input type="text" data-id="{{$row->id}}" data-rowId="{{$row->rowId}}" name="qty[{{$row->rowId}}]" value="{{$row->qty}}" class="num-order" readonly>
                                <span title="" class="plus1"><i class="fa fa-plus"></i></span>
                            </td>
                            <td>
                                <span class="sub-total{{$row->id}}">{{ number_format($row->total, 0, ',', '.') }}</span>đ
                            </td>
                            <td>
                                <a href="{{route('cart.remove', $row->rowId)}}" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>                       
                        @endforeach                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá:  <span><strong id="total-cart">{{ Cart::total() }}</strong> <span class="text-lowercase">đ</span></span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <input type="submit"  value="Cập nhật giỏ hàng" title="" id="update-cart">
                                        <a href="{{url('thanh-toan')}}" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>         
            </div> -->
                <div class="container-fluid head-ls-product-cart">
                    <div class="row">
                        <div class="col-2">
                            Ảnh sản phẩm
                        </div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col-6">
                                    Tên sản phẩm
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="row">
                                                <div class="col-5">
                                                    Số lượng
                                                </div>
                                                <div class="col-5">Thành tiền</div>
                                            </div>
                                        </div>
                                        <div class="col-2 text-center">Tác vụ</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                $temp = 0;
                @endphp
                @foreach (Cart::content() as $row)
                <div class="container-fluid item-product-cart">
                    <div class="row">
                        <div class="col-4 col-md-2 col-img-item-cart">
                            <a href="" title="" class="thumb img-product-show-cart">
                                <img src="{{asset($row->options->thumbnail)}}" alt="">
                            </a>
                        </div>
                        <div class="col-8 col-md-10 col-info-product">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <a href="" title="" class="name-product truncate2">{{$row->name}}</a>
                                    <p class="unit-cart"><span class="font-weight-bold">Đơn giá: </span><span class="text-dark">{{ number_format($row->price, 0, ',', '.') }}đ / {{$row->options->unit}}</span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="row">
                                                <div class="col-12 col-md-5">
                                                    <div class="wp-num-cart">
                                                        <span title="" class="minus1"><i class="fa fa-minus"></i></span>
                                                        <input type="text" data-id="{{$row->id}}" data-rowId="{{$row->rowId}}" data-url="{{route('updateCartAjax')}}" data-qtyFrist="{{$row->qty}}" name="qty[{{$row->rowId}}]" value="{{$row->qty}}" class="num-order" min="1" max="{{$row->options->inventory}}" maxlength="{{strlen($row->options->inventory)}}">
                                                        <span title="" class="plus1"><i class="fa fa-plus"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-5 mt-2 mt-md-0 font-weight-bold"><span class="sub-total{{$row->id}}">{{ number_format($row->total, 0, ',', '.') }}</span>đ</div>
                                            </div>
                                        </div>
                                        <div class="col-2 text-center"><a href="{{route('cart.remove', $row->rowId)}}" title="" class="del-product"><i class="fa fa-trash-o"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="total-cart-show">
                    <p id="total-price" class="">Tổng giá: <span><strong id="total-cart">{{ Cart::total() }}</strong> <span class="text-lowercase">đ</span></span></p>
                </div>
                <div class="text-right">
                    <input type="submit" value="Cập nhật giỏ hàng" title="" id="update-cart">
                    <a href="{{url('thanh-toan')}}" title="" id="checkout-cart">Thanh toán</a>
                </div>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                    @if (Auth::check())
                    <a href="{{url('/home')}}" title="">Mua tiếp</a><br />
                    @else
                    <a href="{{url('/')}}" title="">Mua tiếp</a><br />
                    @endif

                    <a href="{{route('cart.destroy')}}" title="" id="delete-cart">Xóa giỏ hàng</a>
                </div>
            </div>
        </div>
    </form>
    @else
    <div class="text-center" style="height :250px; font-size: 18px"><span>Không có sản phẩm nào trong giỏ hàng! Nhấn vào @if (Auth::check())
            <a href="{{url('/home')}}" title="">Trang chủ</a>
            @else
            <a href="{{url('/')}}" title="">Trang chủ</a>
            @endif để tiếp tục mua hàng.</span></div>
    @endif
</div>

@endsection