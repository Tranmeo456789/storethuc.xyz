@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Sửa bài viết
        </div>
        <div class="card-body">
            <form action="{{route('post.update',  $post->id)}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="form-group">
                    <label for="name">Tiêu đề bài viết</label>
                    <input class="form-control" type="text" name="title_post" value="{{$post['title']}}" id="name" autocomplete="off">
                    @error('title_post')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea name="content_post" class="form-control" id="mytextarea" cols="30" rows="5">{{$post['content']}}</textarea>
                    @error('content_post')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="file-post">Ảnh đại diện</label>
                    <input type="file" name="file" id="file-post" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>                   
                    <select name="cat_post" class="form-control" id="">
                        @foreach ($cat_posts as $item)
                                    @if ($item['parent_id'] == 0)
                                        <option value="{{ $item['id'] }}" class="font-weight-bold">{{ $item['title'] }}</option>
                                    @else
                                        <option value="{{ $item['id'] }}">{{ str_repeat('-', $item['level']) }}{{ $item['title'] }}</option>
                                    @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status1" value="Chờ duyệt" checked>
                        <label class="form-check-label" for="status1">
                          Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="Công khai">
                        <label class="form-check-label" for="exampleRadios2">
                          Công khai
                        </label>
                    </div>
                </div>
                <button type="submit" name="update_post" value="Thêm mới" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection