
@extends('layouts.admin')
<style>
    .active_color {
    border: 2px solid gray;
    height: 22px;
}
</style>
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-success text-center">
                        {{session('status')}}
                        <a href="" class="text-primary m-l-2" style="font-size: 22px; "><i class="far fa-check-circle"></i></a>                  
                    </div>
                @endif
                <div class="card-header font-weight-bold">
                    Thêm màu
                </div>
                <div class="card-body">
                    <form action="{{url('admin/product/add_color')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên màu</label>
                            <input class="form-control" type="text" name="name_color" value="" id="name" autocomplete="off" >
                            @error('name_color')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="colorpicker">Chọn màu</label>
                            <input class="form-control" type="color" name="color_select" id="colorpicker" value="#000000">
                        </div>
                        <div class="form-group">
                            <label for="">Mã màu</label>
                            <input id="hexcolor" name="code_color" value="" class="form-control text-center" style="font-weight: 700; text-transform: uppercase " disabled>
                        </div>
                        
                        <button type="submit" name="btn-add-color" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách màu
                </div>
                <div class="card-body" style="min-height: 500px">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Mã màu</th>
                                <th scope="col">Hiển thị</th>
                                <th scope="col" class="text-center">Tác vụ</th>
                            </tr>
                        </thead>
                        @php
                            $temp=0;
                        @endphp
                        <tbody>
                            @if ($color_products->count()>0)
                                @foreach ($color_products as $item)
                                    @php
                                    $temp++;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{$temp}}</th>
                                        <td>{{$item->name_color}}</td>
                                        <td><span class="text-uppercase">{{$item->code_color}}</span></td>
                                        <td><div  style="width: 100px;height: 20px; border: 1px solid gray; background-color: {{$item->code_color}}"></div></td>
                                        <td class="text-center"><a href="{{route('delete.color', $item->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này ?')"></i></a></td>
                                    </tr>
                                @endforeach  
                            @else
                                <tr>                     
                                    <td colspan="5"><span class="text-danger">Không có bản ghi nào</span></td>                                   
                                </tr>
                            @endif      
                        </tbody>
                    </table>
                </div>
                {{$color_products->links()}}
            </div>
        </div>
    </div>

</div>
@endsection

    