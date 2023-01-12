@php
    use App\Helpers\Template;
    use App\Model\UserModel;
@endphp
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>STT</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Quyền</th>
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
                $nameRole=$val->roleUser->toArray();   
                    
            @endphp
            <tr>
                <td style="width: 5%">{{$temp}}</td>
                <td style="width: 25%" class="img-in-table"><div>{{$val->name}}</div></td>
                <td style="width: 20%">{{$val->email}}</td>
                <td style="width: 25%">{{$nameRole[0]['display_name']??null}}</td>
                <td style="width: 10%" class="text-center">{{$val->created_at}}</td>
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