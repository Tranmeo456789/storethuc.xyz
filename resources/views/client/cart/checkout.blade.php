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
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <form action="{{route('OrderSuccess')}}" method="POST">
            @csrf
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6 pb-2">
                            <label for="fullname">Họ tên <small class="text-danger">(*)</small></label>
                            <input type="text" name="fullname" value="{{old('fullname')}}" id="fullname">
                            @error('fullname')
                                    <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 pb-2">
                            <label for="phone">Số điện thoại <small class="text-danger">(*)</small></label>
                            <input type="tel" name="phone" value="{{old('phone')}}" id="phone">
                            @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>   
                        <div class="col-12 col-md-12 pb-2">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{old('email')}}" id="email">
                            @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> 
                        <div class="col-12 col-md-12">
                            <label for="address">Địa chỉ <small class="text-danger">(*)</small></label>
                        </div> 
                        <div class="col-12 col-md-6 pb-3">
                            <select name="city" class="form-control choose1 city" id="city" data-href="{{route('locationAjax')}}">
                                <option value="">--Chọn tỉnh thành phố--</option>
                                @error('city')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                @foreach ($city as $item)
                                    <option value="{{$item->matp}}">{{$item->name_tinh}}</option>
                                @endforeach                                  
                            </select>
                            @error('city')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>  
                        <div class="col-12 col-md-6 pb-3">
                            <select name="province" class="form-control choose1 province" id="province" data-href="{{route('locationAjax')}}">
                                <option value="">--Chọn quận huyện--</option>   
                            </select>
                            @error('province')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 pb-3">
                            <select name="wards" class="form-control wards" id="wards">
                                <option value="">--Chọn xã phường--</option>   
                            </select>
                            @error('wards')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 pb-3">
                            <input type="text" name="address" id="address" placeholder="Số nhà, tên đường">
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12 col-md-12">
                            <label >Ghi chú</label>
                            <textarea name="note" style="width: 100%;height: 110px;">{{old('note')}}</textarea>
                        </div>
                    </div>
            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>
            <div class="section-detail">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach (Cart::content() as $row)
                            <tr class="cart-item">
                                <td class="product-name">{{$row->name}}<strong class="product-quantity">x {{$row->qty}}</strong></td>
                                <td class="product-total">{{ number_format($row->total, 0, ',', '.') }} đ</td>
                            </tr>                      
                        @endforeach                        
                    </tbody>
                    <tfoot>
                        <tr class="order-total">
                            <td style="width:70%">Tổng đơn hàng:</td>
                            <td><strong class="total-price">{{ Cart::total() }} <span style="text-transform: lowercase">đ</span></strong></td>
                        </tr>
                    </tfoot>
                </table>
                <div id="payment-checkout-wp">
                    <ul id="payment_methods">
                        
                        <li>
                            <input type="radio" id="payment-home" name="payment-method" value="Thanh toán tại nhà" checked="checked">
                            <label for="payment-home">Thanh toán tại nhà</label>
                        </li>
                    </ul>
                </div>
                <div class="place-order-wp clearfix">
                    <input type="submit" id="order-now" value="Đặt hàng">
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection