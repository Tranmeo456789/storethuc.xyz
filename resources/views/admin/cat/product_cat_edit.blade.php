@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục sản phẩm cần sửa
                </div>
                <div class="card-body">
                    <form action="{{route('admin.product.cat.update',  $product_cat_current->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="cat-title">Tên danh mục</label>
                            <input class="form-control" type="text" name="cat_title" value="{{$product_cat_current->title}}" id="cat-title" autocomplete="off">
                            @error('cat_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="">Danh mục cha</label>
                            <select name="parent_id" class="form-control" id="">
                                <option value="0">Không có danh mục cha</option>
                                <!-- @foreach ($product_cats_unset as $item)
                                    @if ($item['parent_id'] == 0)
                                        <option value="{{ $item['id'] }}" class="font-weight-bold">{{ $item['title'] }}</option>
                                    @else
                                        <option value="{{ $item['id'] }}">{{ str_repeat('-', $item['level']) }}{{ $item['title'] }}</option>
                                    @endif
                                @endforeach -->
                            </select>
                        </div>
                        <button type="submit" name='edit_cat' value='Cập nhật' class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách <span style="text-transform: none">({{$num_cat}} danh mục)</span>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        @php
                            $temp = 0;
                        @endphp
                        <tbody>
                            @foreach ($product_cats as $product_cat)
                                @php
                                    $temp++;
                                @endphp
                                @if ($product_cat['parent_id'] == 0)
                                    <tr class="">
                                        <th scope="row">{{ $temp }}</th>
                                        <td>
                                            {{ str_repeat('--', $product_cat['level']) }}
                                            {{ $product_cat['title'] }}
                                        </td>
                                        <td>{{ Str::slug($product_cat['title']) }}</td>
                                        <td>
                                            <a href="{{route('product_cat.edit',$product_cat->id)}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @else
                                    <tr class="font-italic">
                                        <th scope="row">{{ $temp }}</th>
                                        <td>
                                            {{ str_repeat('--', $product_cat['level']) }}
                                            {{ $product_cat['title'] }}
                                        </td>
                                        <td>{{ Str::slug($product_cat['title']) }}</td>
                                        <td>
                                            <a href="{{route('product_cat.edit', $product_cat->id)}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>                                            
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection