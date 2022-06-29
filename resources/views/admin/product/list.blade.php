@extends('layouts.admin')

@section('content')
<div class="fix-content">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 "><a href="{{url('admin/product/list')}}">Danh sách sản phẩm</a></h5>
             @if (session('status'))
                <div class="alert alert-success text-center">
                    {{session('status')}}
                    <a href="" class="text-primary m-l-2" style="font-size: 22px; "><i class="far fa-check-circle"></i></a> 
                </div>
            @endif
            @if (isset($update_product))
            @if($update_product==1)
            <div class="alert alert-success text-center">
                Bạn đã update thành công                
                <a href="" class="text-primary m-l-2" style="font-size: 22px; "><i class="far fa-check-circle"></i></a> 
            </div>
            @endif
            @endif
            
            <div class="form-search form-inline">
            @if ($trash==0)
                <form action="{{url('admin/product/list')}}">
             @else
                <form action="{{url('admin/product/list_trash')}}"> 
            @endif
                    <input type="search" name="keyword_product" value="{{request()->input('keyword_product')}}" class="form-control form-search" placeholder="Tìm kiếm" autocomplete="off" >
                    {{-- <input type="submit" name="search_product" value="Tìm kiếm" class="btn btn-primary"> --}}
                    <button type="submit" name="search_product" value="Tìm kiếm" class="btn btn-primary">Tìm kiếm</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{url('admin/product/list_still')}}" class="text-primary {{$still==1?"active-status":""}}">Còn hàng<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{route('product.list_wait')}}" class="text-primary {{$wait==1?"active-status":""}}">Hết hàng<span class="text-muted">({{$count[1]}})</span></a>
                <a href="{{url('admin/product/list_trash')}}" class="text-primary {{$trash==1?"active-status":""}}">Thùng rác<span class="text-muted">({{$count[2]}})</span></a>
            </div>
        <form action="{{url('admin/product/action')}}">
            <div class="form-action form-inline py-3">
                <select name="act" class="form-control mr-1" id="">
                    <option value="start">Chọn tác vụ</option>
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
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($products->total()>0)
                    @php
                    $temp=0;
                @endphp
                @foreach ($products as $product)
                @php
                    $temp++;
                @endphp
                <tr class="">
                    <td>
                        <input name="list_check[]" value="{{$product['id']}}" type="checkbox">
                    </td>
                    <td>{{$temp}}</td>
                    @if ($product->thumbnail)
                        <td><img style="max-width: 100px;" src="{{asset($product->thumbnail)}}" alt="" class="img-fluid"></td>
                    @else
                    <td ><div class="border border-danger text-center" style=" width: 100px; height: 80px;">Trống</div></td>
                    @endif 
                    <td><a href="#">{{$product['name']}}</a></td>
                    <td>{{ number_format( $product['price_current'], 0, "" ,"." )}}đ</td>
                    @foreach ($cat_products as $item)
                        @if ($item['id']==$product['cat_id'])
                        <td>{{$item['title']}}</td>
                        @endif                                                
                    @endforeach
                    <td style="with:50px">{{$product['created_at']}}</td>
                    <td><span class="badge  {{$product['status']=='Còn hàng'?'badge-success':'badge-dark'}}">{{$product['status']}}</span></td>
                    @if ($trash==0)
                    <td>
                        <a href="{{route('product.edit', $product-> id )}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="{{route('product.delete', $product-> id )}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này ?')"></i></a>
                       
                        <span class="mt-md-1 d-md-block d-xl-inline-block"><a href="{{route('product.add_img',$product-> id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Thêm hình ảnh"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></span>
                        
                        
                    </td>
                    @else
                    <td>
                        <a href="{{route('product.forcedelete', $product-> id )}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này ?')"></i></a>
                    </td>
                    @endif
                </tr>
                @endforeach
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
{{$products->links()}}
@endsection