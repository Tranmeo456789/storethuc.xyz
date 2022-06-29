@extends('layouts.app')

@section('content')
<div id="main-content-wp" class="checkout-page">
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
                <p>Cảm ơn quý khách đã đặt hàng tại hệ thống Ismart!</p>
                <p>Nhân viên chăm sóc sẽ liên hệ tới bạn sớm nhất.</p>
            </div>
            <div class="section" id="thank-wp">
                <div class="section-head">
                    <h5 class="section-title">Mã đơn hàng: {{$data['code_order']}}</h5>
                </div>
                <div class="section-detail">
                    <div class="section">
                        <div class="section-head">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-block ml-2">Thông tin khách hàng:</h5>
                                    <table class="table table-bordered">
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
                                    </table>
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
                                                <th scope="col">Giá</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $temp=0;
                                            @endphp
                                            @foreach (Cart::content() as $item)
                                            @php
                                                $temp++;
                                            @endphp
                                                <tr>
                                                    <td>{{$temp}}</td>
                                                    <td style="max-width:80px;"><img src="{{asset($item->options->thumbnail)}}" alt="" class="img-fluid" style="width: 100%"></td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                                    <td>{{$item->qty}}</td>
                                                    <td>{{ number_format($item->total, 0, ',', '.') }}đ</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="5">Giá trị đơn hàng</th>
                                                <td>{{Cart::total()}}đ</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="back-home">
                                @if (Auth::check())
                                    <a href="{{url('/home')}}" title="">Quay lại trang chủ</a>
                                @else
                                    <a href="{{url('/')}}" title="">Quay lại trang chủ</a>
                                @endif 
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection