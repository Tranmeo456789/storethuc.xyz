@extends('layouts.app')
@section('content')
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Đặt hàng thành công</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div id="content">
            <div class="thanks text-center mb-4">
                <h4 class="text-success font-weight-bold">Đặt hàng thành công!</h4>
                <p class="mb-0">Cảm ơn quý khách đã đặt hàng tại đây!</p>
                <p>Nhân viên chăm sóc sẽ liên hệ tới bạn sớm nhất.</p>
            </div>
            <div class="section" id="thank-wp">
                <div class="section-head mb-1">
                    <h5 class="section-title font-weight-bold">Mã đơn hàng: <span class="text-success">{{$order['code_order']}}</span></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="section-detail wp-inner-fluid">
        <div class="section">
            <div class="section-head mt-3">
                <div class="">
                    <div class="">
                        <h5 class="d-block mb-2 font-weight-bold">Thông tin khách hàng:</h5>
                        <div class="container-fluid">
                            <div class="hidden-when-768">
                                <div class="row">
                                    <div class="col-md-2 wp-item-table">
                                        <span class="font-weight-bold">Họ tên</span>
                                    </div>
                                    <div class="col-md-2 wp-item-table">
                                        <span class="font-weight-bold">Số điện thoại</span>
                                    </div>
                                    <div class="col-md-5 wp-item-table text-center">
                                        <span class="font-weight-bold">Địa chỉ</span>
                                    </div>
                                    <div class="col-md-3 wp-item-table">
                                        <span class="font-weight-bold">Email</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 wp-item-table">
                                    <span class="font-weight-bold view-when-768">Họ tên: </span><span class="">{{$order['buyer']['fullname']}}</span>
                                </div>
                                <div class="col-md-2 wp-item-table mt-table-1">
                                    <span class="font-weight-bold view-when-768">Số điện thoại: </span><span class="">{{$order['buyer']['phone']}}</span>
                                </div>
                                <div class="col-md-5 wp-item-table mt-table-1">
                                    <span class="font-weight-bold view-when-768">Địa chỉ: </span><span class="">{{$order['buyer']['address']}}</span>
                                </div>
                                <div class="col-md-3 wp-item-table mt-table-1">
                                    <span class="font-weight-bold view-when-768">Email: </span><span class="">{{$order['buyer']['email']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-table-1 mt-3">
                    <div class="">
                        <h5 class="d-block mb-2 font-weight-bold">Thông tin đơn hàng:</h5>
                        <div class="container-fluid">
                            <div class="hidden-when-768">
                                <div class="row wp-item-table">
                                    <div class="col-1 font-weight-bold text-center"><span>STT</span></div>
                                    <div class="col-3 col-md-2 text-center font-weight-bold">Hình ảnh</div>
                                    <div class="col-8 col-md-9">
                                        <div class="row">
                                            <div class="col-12 col-md-6 font-weight-bold">
                                                Tên sản phẩm
                                            </div>
                                            <div class="col-6 col-md-3 font-weight-bold text-center">
                                                Số lượng
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span class="font-weight-bold">Thành tiền</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                            $temp=0;
                            @endphp
                            @foreach ($order['info_product'] as $item8)
                            @php
                            $temp++;
                            @endphp
                            <div class="row wp-item-table ls-item-order-success mb-1px">
                                <div class="col-1 text-center col-item-info">
                                    <span>{{$temp}}</span>
                                </div>
                                <div class="col-3 col-md-2 col-item-info">
                                    <div class="wp-img-ordersuccess">
                                        <img src="{{asset($item8['image'])}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-8 col-md-9 col-item-info">
                                    <div class="row row-mr0">
                                        <div class="col-12 col-md-6 col-item-info">
                                            <p class="truncate3 text-primary mb-0">{{$item8['name']}}</p>
                                            <small><span class="font-weight-bold">Đơn giá: </span><span class="text-dart">{{number_format($item8['price'], 0, "" ,"." )}}đ / {{$item8['unit']}}</span></small>
                                        </div>
                                        <div class="col-6 col-md-3 item-center-768 col-item-info">
                                            <span class="font-weight-bold view-when-768">Số lượng: </span><span>{{$item8['quantity']}}</span>
                                        </div>
                                        <div class="col-6 col-md-3 col-item-info monney-item">
                                            <span class="font-weight-bold">{{number_format($item8['total_money'], 0, "" ,"." )}}đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="row wp-item-table">
                                <div class="col-6 text-right">
                                   Phí vận chuyển:
                                </div>
                                <div class="col-6 text-left">
                                    <span class="text-secondary font-weight-bold">{{number_format($order['value_fee_ship'], 0, "" ,"." )}}đ</span>
                                </div>
                                <div class="col-6 font-weight-bold text-right">
                                   Tổng giá trị đơn hàng:
                                </div>
                                <div class="col-6 text-left">
                                    <span class="text-danger font-weight-bold">{{number_format($order['total'], 0, "" ,"." )}}đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="back-home">
                    <a href="{{url('/')}}" title="">Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection