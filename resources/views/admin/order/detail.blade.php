@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex align-items-center">            
            <h5 class="m-0 mr-5"><a href="">Thông tin đơn hàng</a></h5>
            @if (session('status'))
            <div class="alert alert-success text-center mb-0 py-1">
                {{session('status')}}
                <a href="" class="text-primary m-l-2" style="font-size: 22px; "><i class="far fa-check-circle"></i></a> 
            </div>
            @endif
        </div>
        <div class="card-body" id="detail-order">
            <h5>Thông tin khách hàng</h5>
            <table style="table-layout:auto; width:100%; font-size:14px;">
                <thead>
                    <tr style="background-color: rgb(247, 242, 242)">
                        <th class="text-center">Mã đơn hàng</th>
                        <th class="text-center">Họ và tên</th>
                        <th class="text-center">Số điện thoại</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Địa chỉ</th>
                        <th class="text-center">Thời gian đặt hàng</th>
                        <th class="text-center">Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td style="width:14%;" class="text-center">{{$order['code_order']}}</td>
                            <td style="width:10%;" class="text-center">{{$order['fullname']}}</td>
                            <td style="width:8%;" class="text-center">{{$guest['phone']}}</td>   
                            <td style="width:15%;" class="text-center">{{$guest['email']}}</td>
                            <td style="width:30%;" class="text-center">{{$guest['address']}}</td>
                            <td style="width:12%;" class="text-center">{{$order['created_at']}}</td>
                            <td style="width:10%;">{{$order['note']}}</td>       
                        </tr>      
                </tbody>
            </table>
            <div class="  mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Trạng thái đơn hàng: 
                            @if ($order['status']=='Hoàn thành')
                                <span style="font-size: 14px" class="px-1 bg-success text-light rounded">{{$order['status']}}</span>
                            @elseif($order['status']=='Đang vận chuyển')
                                <span style="font-size: 14px" class="px-1 bg-info text-light rounded">{{$order['status']}}</span>
                            @elseif($order['status']=='Đang xử lý')
                                <span style="font-size: 14px" class="px-1 badge-warning rounded">{{$order['status']}}</span>
                            @else
                                <span style="font-size: 14px" class="px-1 bg-danger text-light rounded">{{$order['status']}}</span>
                            @endif
                        </h5>   
                        <div class="form-action form-inline py-2">
                            <form action="{{route('order.update_status',$order->id)}}" method="POST">
                                @csrf
                                <select name="status_order" class="form-control mr-2">
                                    <option value="{{$status}}">{{$status}}</option>
                                        @foreach ($list_status as $item9)
                                            <option value="{{$item9}}">{{$item9}}</option>
                                        @endforeach
                                </select>
                                <input type="submit" name="btn-update" value="Cập nhật" style="padding: 5px 8px;border:1px solid rgb(163, 241, 241);color:aliceblue" class="rounded bg-primary">
                            </form>
                        </div>
                    </div> 
                    <div class="col-md-6" style="">
                        <table style="table-layout: fixed;width:100%;font-size:14px">
                            <thead>
                                <tr style=" background-color: rgb(247, 242, 242)">
                                    <th class="text-center">Tổng số lượng</th>
                                    <th class="text-center">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td class="text-center">{{$qty_total}}</td>
                                        <td class="text-center">{{number_format($order['price_total'], 0, "" ,"." )}} đ</td>
                                    </tr>      
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">            
            <h5 class="m-0 "><a href="">Chi tiết đơn hàng</a></h5>
        </div>
        <div class="card-body">
            <table style="table-layout: auto;width:100%;font-size:16px;">
                <thead>
                    <tr style="border-bottom: 1px solid gray; background-color: rgb(247, 242, 242)">
                        <th class="text-center py-2">Ảnh sản phẩm</th>
                        <th class="text-center">Tên sản phẩm</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Giá</th>
                        <th class="text-center">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $item8)
                        <tr style="border-bottom: 1px solid rgb(241, 229, 229);">
                            <td style="width:15%;" class="text-center p-2"><img src="{{asset($item8['thumbnail'])}}" alt="" class="img-fluid" style="max-width:110px;"></td>
                            <td style="width:40%;" class="text-center">{{$item8['name']}}</td>
                            <td style="width:15%;" class="text-center">{{$item8['qty']}}</td>   
                            <td style="width:15%;" class="text-center">{{number_format($item8['price_current'], 0, "" ,"." )}} đ</td>
                            <td style="width:15%;" class="text-center">{{number_format($item8['price_current']*$item8['qty'], 0, "" ,"." )}} đ</td>
                        </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection