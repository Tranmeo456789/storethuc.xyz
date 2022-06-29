
@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    
    <div class="card">     
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 "><a href="{{url('admin/user/list')}}">Danh sách thành viên</a></h5> 
            @if (session('status'))
                <div class="alert alert-success text-center">
                    {{session('status')}}
                    <p class="mb-0 pt-1"><a href="" class="text-danger p-1 border rounded" style="background: rgb(136, 233, 228) ">Ok</a></p>
                </div>
            @endif          
            <div class="form-search form-inline">
                @if ($active==1)
                    <form action="{{url('admin/user/list_active')}}">
                @endif
                @if ($trash==1)
                    <form action="{{url('admin/user/list_trash')}}">
                @else
                    <form action="{{url('admin/user/list')}}">
                @endif
                    <input type="text" name="keyword" value="{{request()->input('keyword')}}" class="form-control form-search" placeholder="Tìm kiếm" autocomplete="off">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{url('admin/user/list_active')}}" class="text-primary {{$active==1?"active-status":""}}">Kích hoạt<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{url('admin/user/list_trash')}}" class="text-primary {{$trash==1?"active-status":""}}">Vô hiệu hóa<span class="text-muted">({{$count[1]}})</span></a>
            </div>
            <form action="{{url('admin/user/action')}}" method="">
                <div class="form-action form-inline py-3">
                    <select  class="form-control mr-1" name="act" id="">
                        <option value="start">Chọn</option>
                        @foreach ($list_act as $k => $act)
                        <option value="{{$k}}">{{$act}}</option>
                        @endforeach                       
                    </select>
                    <input type="submit" name="btn-apply" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr class="bg-light">
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">STT</th>
                            <th scope="col" class="text-center">Họ tên</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Quyền</th>
                            <th scope="col" class="text-center">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->total()>0)
                        @php
                        $temp=0;
                    @endphp
                    @foreach ($users as $user)
                    @php
                        $temp++;
                    @endphp
                    <tr class="bg-white">
                        <td>
                            <input type="checkbox" name="list_check[]" value="{{$user->id}}">
                        </td>
                        <td scope="row" class="text-center">{{$temp}}</td>
                        <td class="text-center">{{$user->name}}</td>                        
                        <td class="text-center">{{$user->email}}</td>
                        <td class="text-center">
                            @foreach ($user->roles1 as $roleitem)
                                {{$roleitem->display_name}}
                            @endforeach 
                         </td>         
                        <td>{{$user->created_at}}</td>
                        <td>
                            <a href="{{route('user.edit',$user->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            @if (Auth::id()!=$user->id)
                                @if ($trash==1)
                                    <a href="{{route('forcedelete_user', $user->id)}}" onclick="return confirm('Bạn có chắc chắn xóa vĩnh viễn bản ghi này ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                @else
                                    <a href="{{route('delete_user', $user->id)}}" onclick="return confirm('Bạn có chắc chắn xóa tạm thời bản ghi này ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                @endif
                                
                            @endif                        
                        </td>
                    </tr> 
                    @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="bg-white text-danger"><p>Không có bản ghi nào được tìm thấy</p></td>
                            </tr>
                        @endif                                                  
                    </tbody>
                </table>
            </form>
            
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection
