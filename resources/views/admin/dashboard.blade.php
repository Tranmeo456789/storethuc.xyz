@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-3">
        <div class="row" style="font-size: 14px">
            <div class="col pr-0">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count[0]}}</h5>
                        <p class="card-text">Đơn giao dịch thành công</p>
                    </div>
                </div>
            </div>
            <div class="col pr-0 pl-2">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐANG VẬN CHUYỂN</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count[1]}}</h5>
                        <p class="card-text">Số đơn đang vận chuyển</p>
                    </div>
                </div>
            </div>
            <div class="col pr-0 pl-2">
                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐANG XỬ LÝ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count[2]}}</h5>
                        <p class="card-text">Số đơn đang xử lý</p>
                    </div>
                </div>
            </div>

            <div class="col pr-0 pl-2">
                <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{number_format($sales, 0, "" ,"." )}} đ</h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                </div>
            </div>
            <div class="col pl-2">
                <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG HỦY</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count[3]}}</h5>
                        <p class="card-text">Số đơn bị hủy</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end analytic  -->
        <div class="card" style="min-height: 400px">
            <div class="card-header font-weight-bold">
                ĐƠN HÀNG MỚI
            </div>
            <div class="card-body">
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col" class="text-center">Trạng thái</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col" class="text-center">Chi tiết</th>
                        </tr>
                    </thead>
                    @php
                    if(!empty($_GET['page']))
                    $page_current=$_GET['page'];
                    @endphp   
                    <tbody>
                    @if ($orders->total()>0)
                        @php
                        if (!empty($page_current)) {
                            $temp=($page_current-1)* 5;
                        } else {
                            $temp=0;
                        } 
                        @endphp  
                            @foreach ($orders as $order)
                            @php
                                $temp++;
                            @endphp
                            <tr>
                            <td>{{$temp}}</td>
                            <td><a href="" class="text-primary">{{$order['code_order']}}</a></td>
                            <td>{{$order['fullname']}}</td>   
                            <td>{{number_format($order['price_total'], 0, "" ,"." )}}đ</td>
                            @if($order['status']=='Hủy')
                                <td class="text-center"><span class="badge badge-danger">{{$order['status']}}</span></td> 
                            
                            @elseif($order['status']=='Đang vận chuyển')
                                <td class="text-center"><span class="badge badge-info">{{$order['status']}}</span></td>
                            @else
                                <td class="text-center"><span class="badge {{$order['status']=='Hoàn thành'?"badge-success":"badge-warning"}}">{{$order['status']}}</span></td> 
                            @endif 
                            <td>{{$order['created_at']}}</td>
                            <td class="text-center"><a href="" class="text-primary border rounded-circle px-1"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a></td>                 
                        </tr>
                        @endforeach                   
                    @else
                        <tr>
                            <td colspan="9" class="text-danger">Không có bản ghi nào</td>
                        </tr>
                    @endif          
                    </tbody>
                </table>
            </div>
        </div>
        {{$orders->links()}}
    </div>
@endsection
