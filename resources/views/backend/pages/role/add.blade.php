@extends('layouts.backend')

@section('content')
<div id="content" class="container-fluid" style="background-color: antiquewhite">
<form action="{{route('backend.role.store')}}" method="POST">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm nhóm quyền
        </div>
        <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="name_role">Tên nhóm quyền</label>
                    <input class="form-control" type="text" name="name" id="name_role" autocomplete="off">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="desc_role">Mô tả nhóm quyền</label>
                    <input class="form-control" type="text" name="desc_role" id="desc_role" autocomplete="off">
                    @error('desc_role')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="card">
                    <div class="card-header" style="background-color: rgb(200, 216, 208);text-transform: none">
                        <label for="">Chọn quyền</label>
                    </div>
                    <div class="card-body">
                        @foreach ($permissionParrent as $pp)
                        <div class="card mt-2 role_detail" style="background-color: aliceblue">
                            <div class="card-header font-weight-bold" style="background-color: rgb(200, 216, 208);text-transform: none">
                                <input type="checkbox" name="" value="" class="checkbox_wp"> Model {{$pp->name}}
                            </div>
                            <div class="card-body">
                                <div >
                                    <div class="row">
                                        @foreach ($pp->PermissionsChildrent as $pc)
                                            <div class="col-md-3">
                                                <input type="checkbox" name="permission_id[]" value="{{$pc->id}}" class="checkbox_child">
                                                {{$pc->name}}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
        </div>
    </div>
    <button type="submit" name="btn_add" value="Thêm mới" class="btn btn-primary mt-3">Thêm mới</button>
</form>
</div>
@endsection
