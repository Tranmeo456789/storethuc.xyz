@php
    use App\Helpers\Template;

@endphp
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Slug</th>
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
                <td style="width: 5%">{{$temp}}</td>
                <td style="width: 45%" class="img-in-table"><div>{{$val->name}}</div></td>
                <td style="width: 20%">{{$val->slug}}</td>
                <td style="width: 15%" class="text-center">{{$val->created_at}}</td>
                <td style="width: 15%">
                    <a href="{{route("backend.$controllerName.edit",$val->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
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