@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 "><a href="{{url('admin/page/list')}}">Danh sách các trang</a></h5>
            @if (session('status'))
                <div class="alert alert-success text-center">
                    {{session('status')}}
                    <p class="mb-0 pt-1"><a href="" class="text-danger p-1 border rounded" style="background: rgb(136, 233, 228) ">Ok</a></p>
                </div>
            @endif
            <div class="form-search form-inline">
                @if ($trash==1)
                        <form action="{{url('admin/page/list_trash')}}">
                    @endif
                    @if ($open==1)
                        <form action="{{url('admin/page/list_open')}}">
                    @endif
                    @if ($wait==1)
                        <form action="{{url('admin/page/list_wait')}}">
                    @else
                        <form action="{{url('admin/page/list')}}">
                    @endif
                    <input type="search" name="keyword" value="{{request()->input('keyword')}}" id="keyword" class="form-control form-search" placeholder="Tìm kiếm"  autocomplete="off">            
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
                <div id="search-result" style="text-transform:none"></div>
            </div>            
        </div>
        
        <div class="card-body">
            <div class="analytic">
                <a href="{{url('admin/page/list_open')}}" class="text-primary {{$open==1?"active-status":""}}">Công khai<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{url('admin/page/list_wait')}}" class="text-primary {{$wait==1?"active-status":""}}">Chờ duyệt<span class="text-muted">({{$count[1]}})</span></a>
                <a href="{{url('admin/page/list_trash')}}" class="text-primary {{$trash==1?"active-status":""}}">Thùng rác<span class="text-muted">({{$count[2]}})</span></a>
            </div>
        <form action="{{url('admin/page/action')}}">
            <div class="form-action form-inline py-3">
                <select name='act' class="form-control mr-1" id="">
                    <option value="start">Chọn</option>
                    @foreach ($list_act as $k=>$v)
                    <option value="{{$k}}">{{$v}}</option>
                    @endforeach                        
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th> 
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                @php
                if(!empty($_GET['page']))
                $page_current=$_GET['page'];
                @endphp
                <tbody>
                    @if($pages->total()>0)
                    @php
                    if (!empty($page_current)) {
                        $temp=($page_current-1)* 10;
                    } else {
                        $temp=0;
                    }                      
                    @endphp
                    @foreach ($pages as $page)
                    @php
                        $temp++;
                    @endphp
                    <tr>
                        <td>
                            <input name="list_check[]" value="{{$page->id}}" type="checkbox">
                        </td>
                        <td scope="row">{{$temp}}</td>
                        {{-- <td><img src="http://via.placeholder.com/80X80" alt=""></td> --}}
                        <td><a href="">{{$page->title}}</a></td>
                        <td>{{$page->slug}}</td>
                        <td>{{$page->created_at}}</td>
                        <td>
                            @if ($trash==0)
                            <a  href="{{route('page.edit', $page->id)}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a  href="{{route('delete_page', $page->id)}}" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này ?')"><i class="fa fa-trash"></i></a>
                            @else
                            <a  href="{{route('forcedelete_page', $page->id)}}" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này vĩnh viễn không?')"><i class="fa fa-trash"></i></a>
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
            {{$pages->links()}}
        </div>
    </div>
</div>
@endsection

