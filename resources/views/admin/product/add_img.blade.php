
@extends('layouts.admin')


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
                        Thêm hình ảnh cho sản phẩm 
                    </div>
                    <div class="card-body">
                        <h4 class="text-info">{{$product->name}}</h4>
                        <form action="{{route('product.update_img',$product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                           
                            <div class="form-group">
                                <label for="file-product">Thêm ảnh phụ</label>
                                <div style="width: 300px;"><input type="file" name="file" id="file-product" class="form-control-file"></div>
                                @error('file')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                @if (session('error'))
                                <small class="text-danger"> {{session('error')}}</small>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="">Chọn màu đi kèm</label>
                                <select name="color_product" class="form-control" id="" style="width: 300px;">
                                    <option value="">Chọn màu</option>
                                    @foreach ($colors as $color)
                                        <option value="{{$color->id}}">{{$color->name_color}}</option>
                                    @endforeach
                                   
                                </select>
                            </div>
                           
                            <input name="add_product" value="Thêm mới" type="submit" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh sách hình ảnh phụ sản phẩm
                    </div>
                    <div class="card-body" style="min-height: 500px">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Hình ảnh phụ</th>
                                    <th scope="col" class="text-center">Tên màu đi kèm</th>
                                    <th scope="col" class="text-center">Tác vụ</th>
                                </tr>
                            </thead>
                            @php
                                $temp=0;
                            @endphp
                            <tbody>
                                @if ($product_imgs->count()>0)
                                    @foreach ($product_imgs as $item)
                                        @php
                                        $temp++;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{$temp}}</th>
                                            <td><img style="max-width: 100px;" src="{{asset($item->image)}}" alt="" class="img-fluid"></td>
                                            <td class="text-center"><span>{{$item->name_color}}</span></td>                                          
                                            <td class="text-center"><a href="{{route('product.delete_img',[$product->id,$item->id])}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này vĩnh viễn ?')"></i></a></td>
                                        </tr>
                                    @endforeach  
                                @else
                                    <tr>                     
                                        <td colspan="4"><span class="text-danger">Không có bản ghi nào</span></td>                                   
                                    </tr>
                                @endif      
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
@endsection
