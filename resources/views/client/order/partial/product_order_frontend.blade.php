@php
    use App\Helpers\MyFunction;
    $statusOrderValue = array_combine(array_keys(config("myconfig.template.column.status_order")),array_column(config("myconfig.template.column.status_order"),'name'));
    unset($statusOrderValue['all']);
@endphp
@if(count($listOrder) > 0)
<div class="tab-content" id="pills-tabContent">
    <div class="table-list-order">
        <div class="header-list-order">
            <p class="wp-40">Mã đơn hàng</p>
            <p class="wp-20 text-center">Số lượng</p>
            <p class="wp-20">Tổng tiền</p>
            <p class="wp-20 d-none d-md-block">Trạng thái</p>
        </div>
        @foreach($listOrder as $item)
        <div class="content-list-order">
            <p class="wp-40 view-detail-order" data-id="{{$item['id']}}" data-href="{{route('order.detail')}}"><a>{{$item['code_order']}}</a></p>
            <p class="wp-20 text-center" >{{$item['total_product']}}</p>
            <p class="wp-20">{{MyFunction::formatNumber($item['total'])}} đ</p>
            <p class="wp-20 d-none d-md-block"> {!! $statusOrderValue[$item['status_order']]!!}</p>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="text-center">
    <div class="d-flex justify-content-center"><img src="{{asset('images/empty-chitiet.png')}}" alt=""></div>
    <p class="text-center">Không có đơn hàng nào</p>
</div>
@endif