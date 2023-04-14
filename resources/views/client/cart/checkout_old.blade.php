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
                            <input type="text" name="email" value="{{old('email')}}" id="email">
                            @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> 
                        <div class="col-12 col-md-12">
                            <label for="address">Địa chỉ <small class="text-danger">(*)</small></label>
                        </div> 
                        <div class="col-12 col-md-6 pb-3">
                            <select name="province" class="form-control choose1 city" id="city" data-href="{{route('locationAjax')}}">
                                <option value="">--Chọn tỉnh thành phố--</option>
                                @foreach ($city as $item)
                                    <option value="{{$item->matp}}">{{$item->name_tinh}}</option>
                                @endforeach                                  
                            </select>
                            @error('province')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>  
                        <div class="col-12 col-md-6 pb-3">
                            <select name="district" class="form-control choose1 province" id="province" data-href="{{route('locationAjax')}}">
                                <option value="">--Chọn quận huyện--</option>   
                            </select>
                            @error('district')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 pb-3">
                            <select name="ward" class="form-control wards" id="wards">
                                <option value="">--Chọn xã phường--</option>   
                            </select>
                            @error('ward')
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
            @include('client.cart.child_checkout.list_product_cart')
        </div>
    </form>
    </div>
</div>
@endsection