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
            <div class="thanks text-center">
                <h4 class="text-success">Đặt hàng thành công!</h4>
                <p class="mb-0">Cảm ơn quý khách đã đặt hàng tại hệ thống Ismart!</p>
                <p>Nhân viên chăm sóc sẽ liên hệ tới bạn sớm nhất.</p>
            </div>
            <div class="section" id="thank-wp">
                <div class="section-head mb-1">
                    <h5 class="section-title">Mã đơn hàng: <span class="text-success">{{$data['code_order']}}</span></h5>
                </div>
                <div class="section-detail">
                    <div class="section">
                        <div class="section-head mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-block ml-2">Thông tin khách hàng:</h5>
                                    <!-- <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Họ Tên</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">Địa chỉ</th>
                                                <th scope="col">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$data['fullname']}}</td>
                                                <td>{{$data['phone']}}</td>
                                                <td>{{$data['address']}}</td>
                                                <td>{{$data['email']}}</td>
                                            </tr>
                                        </tbody>
                                    </table> -->
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
                                                <span class="font-weight-bold view-when-768">Họ tên: </span><span class="">{{$data['fullname']}}</span>
                                            </div>
                                            <div class="col-md-2 wp-item-table mt-table-1">
                                                <span class="font-weight-bold view-when-768">Số điện thoại: </span><span class="">{{$data['phone']}}</span>
                                            </div>
                                            <div class="col-md-5 wp-item-table mt-table-1">
                                                <span class="font-weight-bold view-when-768">Địa chỉ: </span><span class="">{{$data['address']}}</span>
                                            </div>
                                            <div class="col-md-3 wp-item-table mt-table-1">
                                                <span class="font-weight-bold view-when-768">Email: </span><span class="">{{$data['email']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-block ml-2">Thông tin đơn hàng:</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Ảnh</th>
                                                <th scope="col">Tên sản phẩm</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        @php
                                        $temp=0;
                                        @endphp
                                        <tbody>
                                            @foreach ($product as $item8)
                                            @php
                                            $temp++;
                                            @endphp
                                            <tr>
                                                <td>{{$temp}}</td>
                                                <td style="max-width:80px;"><img src="{{asset($item8['thumbnail'])}}" alt="" class="img-fluid" style="width: 100%"></td>
                                                <td>
                                                    <p class="truncate3 text-primary">{{$item8['name']}}</p>
                                                    <small><span class="font-weight-bold">Đơn giá: </span><span class="text-dart">{{number_format($item8['price_current'], 0, "" ,"." )}}đ / {{$item8['unit']}}</span></small>
                                                </td>

                                                <td>{{$item8['qty']}}</td>
                                                <td><span class="font-weight-bold">{{number_format($item8['price_current']*$item8['qty'], 0, "" ,"." )}}đ</span></td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="4">Giá trị đơn hàng</th>
                                                <td><span class="text-danger font-weight-bold">{{number_format($order['price_total'], 0, "" ,"." )}}đ</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="back-home">
                                <a href="{{url('/')}}" title="">Quay lại trang chủ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection