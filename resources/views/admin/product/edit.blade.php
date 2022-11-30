@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật sản phẩm
            </div>
            <div class="card-body">
                <form action="{{ route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="product-name">Tên sản phẩm</label>
                                
                                <input class="form-control" type="text" name="product_name" value="{{$product['name']}}" id="product-name" autocomplete="off">
                                @error('product_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product-price">Giá</label>
                                <input class="form-control" type="text" name="price" value="{{$product['price_current']}}" id="product-price" autocomplete="off" >
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Đơn vị tính</label>
                                <select name="unit" class="form-control">
                                    @foreach($units as $item)
                                        <option value="{{$item['name']}}" {{$item['name'] == $product['unit'] ? " selected = 'selected' " : '' }}  >{{$item['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="max-width: 300px;">
                                <label for="file-product">Ảnh đại diện</label>
                                <input type="file" name="file" id="file-slider" class="form-control-file @error('file')  is-invalid @enderror" onchange="show_upload_image()">
                                <div><img src="
                                    @php
                                        if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
                                            echo asset('/').'uploads/images/product/'.$_FILES['file']['name'];
                                        }else{
                                            echo asset('/').$product['thumbnail'];
                                        }
                                    @endphp" 
                                    alt="" id="image-slider" class="border img-fluid" style="max-width: 50%">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="describe">Mô tả ngắn</label>
                                <div><textarea name="describe" id="describe"  class="form-control" style="height: 100%" cols="30" rows="5">{{$product['describe']}}</textarea></div>
                                @error('describe')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="mytextarea">Chi tiết sản phẩm</label>
                        <textarea name="product_content" id="mytextarea" class="form-control" cols="30" rows="5">{{$product['content']}}</textarea>
                        @error('product_content')
                            <small class="text-danger">{{$message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục cha</label>
                        <select name="product_cat" class="form-control choose" id="product-cat">
                            <option value="">Chọn danh mục cha</option>
                            @foreach ($cat_products as $cat_product)
                                @if ($cat_product['parent_id']==0)
                                <option value="{{$cat_product['id']}}" {{$cat_product['id'] == $product['cat_id'] ? " selected = 'selected' " : '' }} > {{ str_repeat('--', $cat_product['level']) }}{{$cat_product['title']}}</option>
                                @endif    
                            @endforeach
                        </select>
                        @error('product_cat')
                            <small class="text-danger">{{$message }}</small>
                        @enderror
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Danh mục con</label>
                        <select name="product_cat_child" class="form-control" id="product-cat-child">
                            <option value="">Chọn danh mục con</option>
                            @foreach ($cat_product_childs as $cat_product_child)
                                <option value="{{$cat_product_child['id']}}" {{$cat_product_child['id']==$product['cat_id_child']?"selected='selected'":''}}>{{$cat_product_child['title']}}</option>   
                            @endforeach
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="Còn hàng" id="exampleRadios1" value="option1" {{$product['status']=="Còn hàng"?"checked='checked'":''}}>
                            <label class="form-check-label" for="exampleRadios1">Còn hàng</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="Hết hàng" id="exampleRadios2" value="option2" {{$product['status']=="Hết hàng"?"checked='checked'":''}}>
                            <label class="form-check-label" for="exampleRadios2">Hết hàng</label>
                        </div>
                    </div>
                    <button name="update_product" value="Thêm mới" type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
