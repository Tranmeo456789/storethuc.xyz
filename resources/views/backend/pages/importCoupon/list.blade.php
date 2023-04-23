@php
    use App\Helpers\MyFunction;
@endphp
<table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
    <thead>
        <tr class="row-heading">
            <th>STT</th>
            <th>Phiếu nhập hàng</th>
            <th>Kho hàng</th>
            <th>Tổng tiền (VNĐ)</th>
            <th>Tác vụ</th>
        </tr>
    </thead>
    @php
        $index=0;
    @endphp
    <tbody>
        @foreach ($items as $val)
        @php
            $index++;
            $total = MyFunction::formatNumber($val->total);
        @endphp
        <tr>
            <th scope="row" style="width: 10%">{{$index}}</th>
            <td style="width: 30%" class='name'>{{$val->name}}</td>
            <td style="width: 30%" class='text-justify'>{{$val->warehouse->name}}</td>
            <td style="width: 20%" class='text-right'>{{$total}}</td>
            <td style="width: 20%">
                <a href="{{route("$controllerName.edit",$val->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                <a data-href="{{route("$controllerName.delete",$val->id)}}" class="btn btn-sm btn-danger btn-delete text-white" data-id="{{$val->id}}" data-toggle="tooltip" data-placement="top" title="Xóa"  data-token="{{csrf_token()}}" >
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>