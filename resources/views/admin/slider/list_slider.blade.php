
@extends('layouts.admin')


@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if (session('status'))
                            <div class="alert alert-success text-center">
                                {{session('status')}}
                                <a href="" class="text-primary m-l-2" style="font-size: 22px; "><i class="far fa-check-circle"></i></a>                  
                            </div>
                        @endif
                    <div class="card-header font-weight-bold">
                        Thêm ảnh slider 
                    </div>
                    <div class="card-body">
                        <h4 class="text-info"></h4>
                        <form action="{{url('admin/slider/add')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                           <div class="row">
                            <div class="form-group col-6">
                                <label for="file-product">Ảnh slider</label>
                                <div style="width: 300px;" class="mb-2"><input type="file" name="file" id="file-slider" class="form-control-file @error('file')  is-invalid @enderror" onchange="show_upload_image()"></div>
                                <div><img src="{{asset('uploads/images/product//')}}
                                    @php
                                        if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
                                            echo '/'.$_FILES['file']['name'];
                                        }else{
                                            echo '/null.png';
                                        }
                                    @endphp" 
                                    alt="" id="image-slider" class="border img-fluid" style="max-width: 50%"></div>
                                @error('file')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                @if (session('error'))
                                <small class="text-danger"> {{session('error')}}</small>
                                @endif
                                
                            </div>
                            <div class="form-group col-6" style="">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="Công khai" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                      Công khai
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="Chờ duyệt">
                                    <label class="form-check-label" for="exampleRadios2">
                                      Chờ duyệt
                                    </label>
                                </div>
                            </div>
                           </div>
                            
                            <input name="add_product" value="Thêm mới" type="submit" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh sách slider
                    </div>
                    <div class="card-body" style="min-height: 500px">
                        <div class="analytic mb-2">
                            <a href="{{request()->fullUrlWithQuery(['status'=>'open'])}}" class="text-primary">Công khai({{$num_open}})<span class="text-muted"></span></a>
                            <a href="{{request()->fullUrlWithQuery(['status'=>'wait'])}}" class="text-primary">Chờ duyệt({{$num_wait}})<span class="text-muted"></span></a>
                        </div>
                        {{-- <div class="form-action form-inline py-3">
                            <select name='act' class="form-control mr-1" id="">
                                <option value="start">Chọn</option>
                                                      
                            </select>
                            <input type="submit" name="btn-apply" value="Áp dụng" class="btn btn-primary">
                        </div> --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Hình ảnh slider</th>
                                    <th scope="col" class="text-center">Trạng thái</th>
                                    <th scope="col" class="text-center">Người tạo</th>
                                    <th scope="col" class="text-center">Ngày tạo</th>
                                    <th scope="col" class="text-center">Tác vụ</th>
                                </tr>
                            </thead>
                            @php
                                $temp=0;
                            @endphp
                            <tbody>
                                @if ($sliders->count()>0)
                                    @foreach ($sliders as $item)
                                        @php
                                        $temp++;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{$temp}}</th>
                                            <td><img style="max-width: 150px;" src="{{asset($item->image)}}" alt="" class="img-fluid"></td>
                                            <td class="text-center"><span>{{$item->status}}</span></td>
                                            <td class="text-center"><span>{{$item->name_user}}</span></td>
                                            <td class="text-center"><span>{{substr($item->created_at, 0, 10)}}</span></td>                                     
                                            <td class="text-center">
                                                @if (isset($wait))
                                                <a href="{{route('slider.delete',$item->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này vĩnh viễn ?')"></i></a>
                                                
                                                <a href="{{route('slider.change_status',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="change status"><i class="fas fa-exchange-alt"></i></a>
                                                @else
                                                <a href="{{route('slider.delete',$item->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này vĩnh viễn ?')"></i></a>
                                                @if ($item->location==1)
                                                    <a href="" class="btn btn-info btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="up" style="pointer-events: none; opacity: 0.5;"><i class="fas fa-arrow-up"></i></a>
                                                @else
                                                <a href="{{route('slider.up',$item->id)}}" class="btn btn-info btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="up"><i class="fas fa-arrow-up"></i></a>
                                                @endif
                                                
                                                <a href="{{route('slider.change_status',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="change status"><i class="fas fa-exchange-alt"></i></a>
                                                @endif
                                                
                                            </td>
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
