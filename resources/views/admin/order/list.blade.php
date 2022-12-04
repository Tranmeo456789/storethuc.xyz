@extends('layouts.admin')

@section('content')
<div class="fix-content">
    <div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">            
            <h5 class="m-0 "><a href="{{url('admin/order/list')}}">Danh sách đơn hàng</a></h5>
            @if (session('status'))
            <div class="alert alert-success text-center">
                {{session('status')}}
                <a href="" class="text-primary m-l-2" style="font-size: 22px; "><i class="far fa-check-circle"></i></a> 
            </div>
            @endif
            <div class="form-search form-inline">
                <form action="">
                    <input type="search" name="keyword_order" value="{{request()->input('keyword_order')}}" class="form-control form-search" placeholder="Tìm kiếm" autocomplete="off" >
                    <input type="submit" name="search_user_order" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{url('admin/order/list_complete')}}" class="text-primary {{$complete==1?"active-status":""}}">Hoàn thành<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{url('admin/order/list_move')}}" class="text-primary {{$move==1?"active-status":""}}">Đang vận chuyển<span class="text-muted">({{$count[1]}})</span></a>
                <a href="{{url('admin/order/list_processing')}}" class="text-primary {{$processing==1?"active-status":""}}">Đang xử lý<span class="text-muted">({{$count[2]}})</span></a>
                <a href="{{url('admin/order/list_cancel')}}" class="text-primary {{$cancel==1?"active-status":""}}">Đơn hàng hủy<span class="text-muted">({{$count[3]}})</span></a>
                <a href="{{url('admin/order/list_trash')}}" class="text-primary {{$trash==1?"active-status":""}}">Thùng rác<span class="text-muted">({{$count[4]}})</span></a>
            </div>
        <form action="{{url('admin/order/action')}}">
            <div class="form-action form-inline py-3">
                <select name="act" class="form-control mr-1" id="">
                    <option value="start">Chọn</option>
                    @foreach ($list_act as $k=>$v)
                        <option value="{{$k}}" >{{$v}}</option>
                    @endforeach  
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col" class="text-center">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col" class="text-center">Chi tiết</th>
                        <th scope="col" class="text-center">Tác vụ</th>
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
                        $temp=($page_current-1)* 10;
                    } else {
                        $temp=0;
                    } 
                    @endphp  
                        @foreach ($orders as $order)
                        @php
                            $temp++;
                        @endphp
                        <tr>
                        <td>
                            <input type="checkbox" name="list_check[]" value="{{$order['id']}}">
                        </td>
                        <td>{{$temp}}</td>
                        <td><a href="{{route('order.detail',$order->id)}}" class="text-primary">{{$order['code_order']}}</a></td>
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
                        <td class="text-center"><a href="{{route('order.detail',$order->id)}}" class="text-primary border rounded-circle px-1"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a></td>
                        @if ($trash==1)
                            <td>
                                <div class="text-center"><a href="{{route('order.forcedelete', $order->id)}}" class="btn btn-danger btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn xóa vĩnh viễn bản ghi này không?')"><i class="fa fa-trash"></i></a></div>
                            </td>
                        @else
                        <td>
                            <div class="text-center"><a href="{{route('order.delete', $order->id)}}" class="btn btn-danger btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này không?')"><i class="fa fa-trash"></i></a></div>
                        </td>
                        @endif                   
                    </tr>
                    @endforeach
               
                {{-- @if ($order_user_deletes->count()>0)
                    @php
                        $temp_next=$temp;
                    @endphp  
                        @foreach ($order_user_deletes as $order_user_delete)
                        @php
                             $temp_next++;
                        @endphp
                        <tr>
                        <td>
                            <input type="checkbox" name="list_check[]" value="{{$order_user_delete['id']}}">
                        </td>
                        <td>{{$temp_next}}</td>
                        <td>{{$order_user_delete['code_order']}}</td>
                        <td class="text-danger">User đã bị xóa</td>   
                        <td>{{$order_user_delete['price_total']}}</td>
                        @if ($order_user_delete['status']=='Hủy')
                            <td class="text-center"><span class="badge badge-danger">{{$order_user_delete['status']}}</span></td> 
                        @else
                            <td class="text-center"><span class="badge {{$order_user_delete['status']=='Hoàn thành'?"badge-success":"badge-warning"}}">{{$order_user_delete['status']}}</span></td> 
                        @endif 
                        <td>{{$order_user_delete['created_at']}}</td>
                        <td class="text-center"><a href="" class="text-primary ">chi tiết</a></td>
                        @if ($trash==1)
                            <td>
                                <div class="text-center"><a href="{{route('order.forcedelete', $order_user_delete->id)}}" class="btn btn-danger btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn xóa vĩnh viễn bản ghi này không?')"><i class="fa fa-trash"></i></a></div>
                            </td>
                        @else
                        <td>
                            <div class="text-center"><a href="{{route('order.delete', $order_user_delete->id)}}" class="btn btn-danger btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này không?')"><i class="fa fa-trash"></i></a></div>
                        </td>
                        @endif                   
                    </tr>
                    @endforeach
                @endif --}}
                {{-- @if($order_user_deletes->count()==0 && $orders->total()==0) --}}
                @else
                    <tr>
                        <td colspan="9" class="text-danger">Không có bản ghi nào</td>
                    </tr>
                @endif          
                </tbody>
            </table>
        </form>   
        </div>
    </div>
</div>
</div>
{{$orders->links()}}
</nav>
@endsection