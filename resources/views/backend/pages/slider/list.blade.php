@php
    use App\Helpers\Template;
    use App\Helpers\MyFunction;

    $statusOrderValue = array_combine(array_keys(config("myconfig.template.column.status_slider")),array_column(config("myconfig.template.column.status_slider"),'name'));
    unset($statusOrderValue['all']);
@endphp
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>STT</th>
                <th>Hình ảnh slider</th>
                <th>Trạng thái</th>
                <th>Người tạo</th>
                <th>Ngày tạo</th>
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
                <td style="width: 5%">{{$val->location}}</td>
                <td style="width: 25%" class="img-in-table"><div><div><img src="{{asset($val->image)}}" alt=""></div></div></td>
                <td style="width: 20%">{!! $statusOrderValue[$val['status_slider']]!!}</td>
                <td style="width: 20%">{{$val->userSlider->name}}</td>
                <td style="width: 15%" class="text-center">{{$val->created_at}}</td>
                <td style="width: 15%">
                    <a href="{{route("backend.$controllerName.edit",$val->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                    @if($val['status_slider'] == 'cong_khai')
                    @if($val['location'] != 1 )
                    <a href="{{route("backend.$controllerName.up",$val->id)}}" class="btn btn-primary btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Lên"><i class="fas fa-arrow-up"></i></a>
                    @endif
                    @endif
                    <a data-href="{{route("backend.$controllerName.delete",$val->id)}}" class="btn btn-sm btn-danger btn-delete text-white" data-id="{{$val->id}}" data-toggle="tooltip" data-placement="top" title="Xóa" data-token="{{csrf_token()}}">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        @else
            @include("$moduleName.blocks.list_empty", ['colspan' => 4])
        @endif
    </tbody>
</table>