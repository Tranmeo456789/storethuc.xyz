@php
    use App\Helpers\Template;

@endphp
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Danh mục</th>
                <th>SL tồn kho</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
    @php
    $temp=0;
    @endphp
    <tbody>
    @if (count($items) > 0)
        @foreach ($items as $val)
            @php
                $temp++;
            @endphp
            <tr>
                <td style="width: 5%">{{$temp}}</td>
                <td style="width: 45%" class="img-in-table">
                    <div class="d-flex">
                        <div class="wp-img-table">
                            <img src="{{asset($val->thumbnail)}}" alt="">
                        </div>                     
                        <div class="info-product ml-1">
                            <p class="text-primary font-weight-bold mb-1">{{$val->name}}</p>
                            <p><small><span class="font-weight-bold">Đơn giá: </span><span>{{number_format($val['price'], 0, "" ,"." )}}đ</span></small></p>
                            <small><span class="font-weight-bold">Đơn vị: </span><span>{{$val->unitProduct->name}}</span></small>
                        </div>
                    </div>
                </td>
                <td style="width: 20%">{{$val->catProduct->name}}</td>
                <td style="width: 15%" class="text-center"><span class="badge {{$val['inventory']==0?'badge-danger':'badge-info'}} ">{{$val['quantity_in_stock']??0}}</span></td>
                <td style="width: 15%">
                    <a href="{{route("backend.$controllerName.edit",$val->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                    <a data-href="{{route("backend.$controllerName.delete",$val->id)}}" class="btn btn-sm btn-danger btn-delete text-white" data-id="{{$val->id}}" data-toggle="tooltip" data-placement="top" title="Xóa" data-token="{{csrf_token()}}">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        @else
            @include("$moduleName.blocks.list_empty", ['colspan' => 6])
        @endif
    </tbody>
</table>