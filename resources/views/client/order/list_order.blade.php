@php
$status= [
        ['name'=>'Tất cả','slug'=>'tat_ca'],
        ['name'=>'Chưa hoàn tất','slug'=>'chua_hoan_tat'],
        ['name'=>'Hoàn tất','slug'=>'hoan_tat'],
        ['name'=>'Đã hủy','slug'=>'da_huy'],
        ['name'=>'Trả hàng','slug'=>'tra_hang']
    ];
@endphp
@extends('layouts.app')
@section('content')
<div class="position-relative" style="min-height: 600px;">
    <div class="banner mb-3">
        <picture>
            <source media="(max-width: 756px)" srcset="{{asset('images/banner_order.png')}}">
            <img src="{{asset('images/banner_order.png')}}" alt="">
        </picture>
    </div>
    <div class="wp-inner">
        <div class="set-screen-600">
            <ul class="nav nav-pills mb-3 header-tab" id="pills-tab" role="tablist">
                @foreach($status as $item)
                <li class="nav-item wp-20 select-status-order" role="presentation" data-status="{{$item['slug']}}" data-href="{{route('order.ajaxFliter')}}" data-phone="{{$phone}}">
                    <button class="nav-link {{$item['slug']=='tat_ca'?'active':''}} wp-100" data-toggle="pill" type="button" role="tab">{{$item['name']}}</button>
                </li>
                @endforeach
            </ul>
        </div>
        <input type="hidden" name="_token" value="kawAD46cInQJWkEm9mcuk34v3pnFlCEGmnaJK40Q">
        <div class="table-order-frontend">
            @include("client.order.partial.product_order_frontend")
        </div>
    </div>
</div>
<div class="wp-detail-order">
    @include("client.order.child_list_order.detail_order")
</div>
@endsection