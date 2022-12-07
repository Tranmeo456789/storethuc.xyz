@extends('shop.layouts.backend')

@section('title', 'Tạo đơn hàng')

@section('header_title', 'Tạo đơn hàng')

@section('body_content')

    <div class="card mt-2 ml-1">
        <div class="card-body">
            <h6>Thông tin khách hàng</h6>
            <form class="form-group order-custorm">
                <input class="form-control" id="input-search-after" type="search" name="" id="" placeholder="Tìm kiếm theo thông tin khách hàng ...." >
                <button class="search-custorm" ><i class="fas fa-search"></i></button>
            </form>
            <div class="text-center p-5"  style="margin: auto">
                    <div><img src="{{url('/public/images/shop/custormnull.PNG')}}" alt="" srcset=""></div>
                    <h6 class="text-center">Chưa có thông tin khách hàng</h6>
                    <div class="text-center mt-3"><button id="btn-add-customer" type="submit" class="btn btn-primary">Thêm khách hàng</button></div>
            </div>
        </div>
    </div>
    <div class="card mt-2 ml-1">
    <div class="card-body">
            <h6>Thông tin sản phẩm</h6>
            <form class="form-group order-custorm">
                <input class="form-control" type="search" name="" id="input-search-after" placeholder="Tìm kiếm theo thông tin sản phẩm...." >
                <button class="search-custorm" ><i class="fas fa-search"></i></button>
            </form>
            <div class="text-center p-5"  style="margin: auto">
                <div><img src="{{url('/public/images/shop/productnull.PNG')}}" alt="" srcset=""></div>
                <h6 class="text-center">Chưa có sản phẩm</h6>
                <div class="text-center mt-3"><button type="submit" class="btn btn-primary">Thêm sản phẩm</button></div>
            </div>
        </div>
    </div>
    <div class="card mt-2 ml-1 pb-1">
        <div class="card-body">
            <h6>Đóng gói và giao hàng</h6>
            <div class="form-group">
                    <select class="form-control" id="">
                        <option>Chọn hình thức</option>
                        <option>Đẩy qua hãng vận chuyển</option>
                        <option>Tự gọi shipper</option>
                        <option>Nhận tại cửa hàng</option>
                        <option>Giao hàng sau</option>
                    </select>
            </div>
        </div>
        <div class="text-center mt-3"><button type="submit" class="btn btn-primary">Tạo đơn hàng</button></div>
    </div>
    <div id="modal-wrapper">
        <div id="modal-customer">
            <div class="modal-header">
                <h5>Thêm khách hàng mới</h5>
                <button id="button-close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên khách hàng<span class="text-danger" >*</span></label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="intro">Số điện thoại<span class="text-danger" >*</span></label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="intro">Địa chỉ cụ thể<span class="text-danger" >*</span></label>
                    <input class="form-control" type="text" name="" id="" placeholder="Nhập số nhà, tên đường, tên khu vực" >
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Khu vực<span class="text-danger" >*</span></label>
                            <select class="form-control" id="">
                                <option>Chọn Tỉnh/Thành phố</option>
                                <option>Hồ Chí Minh</option>
                                <option>Hà Nội</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Quận/Huyện<span class="text-danger" >*</span></label>
                            <select class="form-control" id="">
                                <option>Chọn Quận/Huyện</option>
                                <option>Quận 12</option>
                                <option>Quận Ba Đình</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-6">
                        <div class="form-group">
                            <label for="name">Phường/Xã<span class="text-danger" >*</span></label>
                            <select class="form-control" id="">
                                <option>Chọn Phường/Xã</option>
                                <option>Phường 5</option>
                                <option>Phường 8</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Mã khách hàng</label>
                            <input class="form-control" type="text" name="" id="" placeholder="Mã mặc định">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-center align-items-center">
                    <a href="" type="" class="text-primary border border-primary rounded p-2">Thoát</a>
                    <button type="submit" class="btn btn-primary ml-2">Thêm</button>
                </div>
            </div>
        </div>
    </div>

@endsection