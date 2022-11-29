
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
                    Thêm đơn vị tính
                </div>
                <div class="card-body">
                    <form action="{{route('backend.unit.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên đơn vị tính</label>
                            <input class="form-control" type="text" name="name" value="" autocomplete="off" >
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" name="btn_add_unit" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách đơn vị tính
                </div>
                <div class="card-body" style="min-height: 500px">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col" class="text-center">Tác vụ</th>
                            </tr>
                        </thead>
                        @php
                            $temp=0;
                        @endphp
                        <tbody>
                            @if ($units->count()>0)
                                @foreach ($units as $item)
                                    @php
                                    $temp++;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{$temp}}</th>
                                        <td>{{$item->name}}</td>
                                        <td class="text-center"><a href="{{route('backend.unit.delete', $item->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này ?')"></i></a></td>
                                    </tr>
                                @endforeach  
                            @else
                                <tr>                     
                                    <td colspan="3"><span class="text-danger">Không có bản ghi nào</span></td>                                   
                                </tr>
                            @endif      
                        </tbody>
                    </table>
                </div>
                {{$units->links()}}
            </div>
        </div>
    </div>

</div>
@endsection

    