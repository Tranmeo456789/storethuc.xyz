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
        @include('client.cart.child_checkout.form_buy')
    </div>
</div>
@endsection