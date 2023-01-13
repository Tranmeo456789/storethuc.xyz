@extends('layouts.backend')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">     
        <div class="card-header card-header-role font-weight-bold d-flex justify-content-between align-items-center">
            <h6 class="m-0 "><a href="">Danh sách nhóm quyền</a></h6> 
            @if (session('status'))
                <div class="alert alert-success text-center mb-0 py-1">
                    {{session('status')}}
                    <a href="" class="text-primary m-l-2" style="font-size: 22px; "><i class="far fa-check-circle"></i></a>
                </div>
            @endif          
            <div><a href="{{route('backend.role.add')}}" class="bg-success text-light py-2 px-3 rounded" title="Thêm mới" >Thêm mới</a></div>
        </div>
        <div class="card-body">
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr class="bg-light">
                            <th scope="col">STT</th>
                            <th scope="col" >Tên nhóm quyền</th>
                            <th scope="col" >Mô tả nhóm quyền</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($roles->total()>0)
                        @php
                        $temp=0;
                    @endphp
                    @foreach ($roles as $role)
                    @php
                        $temp++;
                    @endphp
                    <tr class="bg-white">
                        <td scope="row" class="text-center">{{$temp}}</td>
                        <td >{{$role->name}}</td>                        
                        <td >{{$role->display_name}}</td>
                        <td>
                            <a href="{{route('backend.role.edit',$role->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('backend.role.delete',$role->id)}}" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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
            {{$roles->links()}}
        </div>
    </div>
</div>
@endsection


