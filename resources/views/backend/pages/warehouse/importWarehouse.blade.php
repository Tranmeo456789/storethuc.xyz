@extends('layouts.backend')

@section('title',$pageTitle)
@section('content')

<section class="content">
    @include("$moduleName.blocks.notify")
    <div class="card">
        <div class="card-body">
            <div class="card">
                <div class="set-withscreen">
                    <div class="list_orderm">
                        <div class="card-body">
                            <table class="table table-striped table-checkall" style="font-size:13px!important; border: none; table-layout: auto;width: 100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã phiếu nhập kho</th>
                                        <th scope="col">Ngày nhập</th>
                                        <th scope="col">Tổng số lượng nhập</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($coupon_imports!=null)
                                    @foreach($coupon_imports as $coupon_import)
                                    <tr class="">
                                        <td><a href="">{{$coupon_import->code_coupon}}</a></td>
                                        <td>{{$coupon_import->created_at}}</td>
                                        <td>{{$coupon_import->qty_total}}</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="xem chi tiết"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{route('warehouse.save.import')}}" method="POST">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="name">Kho hàng</label>
                            <select class="form-control" name="warehouse">
                                @foreach($warehouses as $warehouse)
                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="name">Nhà sản xuất</label>
                            <select class="form-control" name="producer">
                                @foreach($producers as $producer)
                                <option value="{{$producer->id}}">{{$producer->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>

                <label for="name">Nhập sản phẩm vào kho</label>
                <div class="">
                    <table class="table table-striped table-checkall table-bordered" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Số lượng nhập</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="">
                                <td style="width: 40%">
                                    <div class="d-flex">
                                        <img style="width:40px;height:40px" src="{{asset($product->image)}}" alt="">
                                        <div class="info-product ml-3">
                                            <p class="text-success font-weight-bold">{{$product->name}}</p>
                                            <p>ID: {{$product->id}}</p>
                                            <p>Mã: {{$product->code}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 5%">
                                    <input class="text-center" name="ls_qty[{{$product->id}}]" type="number" min="1">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center my-2">
                    <button id="" class="btn btn-primary" name="add_warehouse" value="1">Áp dụng</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection