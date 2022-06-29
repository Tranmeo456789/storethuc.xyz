@extends('layouts.admin')

@section('content')
<div class="fix-content">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 "><a href="{{url('admin/post/list')}}">Danh sách bài viết</a></h5>
                @if (session('status'))
                <div class="alert alert-success text-center">
                    {{session('status')}}
                    <a href="" class="text-primary m-l-2" style="font-size: 22px; "><i class="far fa-check-circle"></i></a>                  
                </div>
            @endif
                <div class="form-search form-inline">
                    @if ($trash==1)
                        <form action="{{url('admin/post/list_trash')}}">
                    @endif
                    @if ($open==1)
                        <form action="{{url('admin/post/list_open')}}">
                    @endif
                    @if ($wait==1)
                        <form action="{{url('admin/post/list_wait')}}">
                    @else
                        <form action="{{url('admin/post/list')}}">
                    @endif
                        <input type="search" name="keyword_post" value="{{request()->input('keyword_post')}}" class="form-control form-search" placeholder="Tìm kiếm" autocomplete="off">
                        <input type="submit" name="search_post" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{url('admin/post/list_open')}}" class="text-primary {{$open==1?"active-status":""}}">Công khai<span class="text-muted">({{$count[0]}})</span></a>
                    <a href="{{url('admin/post/list_wait')}}" class="text-primary {{$wait==1?"active-status":""}}">Chờ duyệt<span class="text-muted">({{$count[1]}})</span></a>
                    <a href="{{url('admin/post/list_trash')}}" class="text-primary {{$trash==1?"active-status":""}}">Thùng rác<span class="text-muted">({{$count[2]}})</span></a>
                </div>
            <form action="{{url('admin/post/action')}}">
                <div class="form-action form-inline py-3">
                    <select name="act" class="form-control mr-1" id="">
                        <option value="start" >Chọn</option>
                        @foreach ($list_act as $k=>$v)
                        <option value="{{$k}}">{{$v}}</option>
                        @endforeach   
                    </select>
                    <input type="submit" name="apply" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($posts->total()>0)
                        @php
                        $temp=0;
                    @endphp
                    @foreach ($posts as $post)
                    @php
                        $temp++;
                    @endphp
                    <tr>
                        <td>
                            <input name="list_check[]" value="{{$post['id']}}" type="checkbox">
                        </td>
                        <td scope="row">{{$temp}}</td>
                        @if ($post->thumbnail)
                            <td><img style="max-width: 100px;" src="{{asset($post->thumbnail)}}" alt="" class="img-fluid"></td>
                        @else
                        <td ><div class="border border-danger text-center" style=" width: 100px; height: 80px;">Trống</div></td>
                        @endif 
                        <td><a href="">{{$post['title']}}</a></td>
                        @foreach ($cat_posts as $item)
                            @if ($item['id']==$post['cat_id'])
                            <td>{{$item['title']}}</td>
                            @endif                                                
                        @endforeach
                        <td>{{$post['created_at']}}</td>
                        @if ($trash==1)
                            <td>
                                <a href="{{route('post.forcedelete',$post->id)}}" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?')"><i class="fa fa-trash"></i></a>
                            </td>
                        @else
                        <td>
                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('post.delete',$post->id)}}" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này ?')"><i class="fa fa-trash"></i></a>
                        </td>
                        @endif
                    </tr>
                    @endforeach 
                        @else
                        <tr>
                            <td colspan="7" class="text-danger">Không có bản ghi nào</td>
                        </tr>
                        @endif
                                          
                    </tbody>
                </table>

            </form>
            </div>
            
        </div>
    </div>
</div>
{{$posts->links()}}
@endsection
