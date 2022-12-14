@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm sản phẩm
            </div>
            <div class="card-body">
                <form action="{{ url('admin/product/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="product-name">Tên sản phẩm</label>        
                                <input class="form-control" type="text" name="product_name" value="{{old('product_name')}}" id="product-name" autocomplete="off">
                                @error('product_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product-price">Giá</label>
                                <input class="form-control" type="text" name="price" value="{{old('price')}}" id="product-price" autocomplete="off">
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Đơn vị tính</label>
                                <select name="unit" class="form-control">
                                    @foreach($units as $item)
                                        <option value="{{$item['name']}}">{{$item['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="describe">Mô tả ngắn</label>
                                <textarea name="describe" class="form-control" id="describe" cols="30" rows="5">{{old('describe')}}</textarea>
                                @error('describe')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="max-width: 300px;">
                        <label for="file-product">Ảnh đại diện</label>
                        <input type="file" name="file" id="file-slider" class="form-control-file @error('file')  is-invalid @enderror" onchange="show_upload_image()">
                        <div><img src="{{asset('uploads/images/product//')}}
                         @php
                            if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
                                echo '/'.$_FILES['file']['name'];
                                }else{
                                    echo '/null.png';
                                }
                        @endphp" 
                        alt="" id="image-slider" class="border img-fluid" style="max-width: 50%">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="mytextarea">Chi tiết sản phẩm</label>
                        <textarea name="product_content" id="mytextarea" class="form-control" cols="30" rows="5">{{old('product_content')}}</textarea>
                        @error('product_content')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục sản phẩm</label>
                        <select name="product_cat" class="form-control choose" id="product-cat">
                            <option value="">Chọn danh mục cha</option>
                            @foreach ($cat_products as $cat_product)
                                @if ($cat_product['parent_id']==0)
                                <option value="{{$cat_product['id']}}">{{ str_repeat('--', $cat_product['level']) }}{{$cat_product['title']}}</option>
                                @endif                              
                            @endforeach
                        </select>
                        @error('product_cat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Danh mục con</label>
                        <select name="product_cat_child" class="form-control" id="product-cat-child">
                            <option value="">Chọn danh mục con</option>
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="Còn hàng" id="exampleRadios1"
                                value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Còn hàng
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="Hết hàng" id="exampleRadios2"
                                value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                Hết hàng
                            </label>
                        </div>
                    </div>
                    <button name="add_product" value="Thêm mới" type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
