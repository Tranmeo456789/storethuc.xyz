@php
    use App\Helpers\Template;
    use App\Helpers\MyFunction;

    $formInputChangeValueAttr    = array_merge_recursive(
                                    config('myconfig.template.form_element.input'),
                                    ['class' => 'sources select_change_attr']
                                    );
    $formInputChangeValueAttr = MyFunction::array_fill_muti_values($formInputChangeValueAttr);
    $statusOrderValue = array_combine(array_keys(config("myconfig.template.column.status_order")),array_column(config("myconfig.template.column.status_order"),'name'));
    unset($statusOrderValue['all']);
@endphp
<div class="set-withscreen">
<table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>STT</th></th>
                <th>Mã đơn hàng</th>
                <th>Doanh thu</th>
                <th>Khách hàng</th>
                <th>Ngày đặt hàng</th>
                <th>Trạng thái</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
    @php
    $index=0;
    @endphp
    <tbody>
    @if (count($items) > 0)
        @foreach ($items as $val)
            @php
                $index++;
                $ngayDatHang = MyFunction::formatDateFrontend($val['created_at']);
                $linkStatusOrder = route('order.changeStatusOrder',['id'=>$val['id'],'value' => 'value_new']);
                //Form::select('status_order',$statusOrderValue, $val['status_order']??null, array_merge($formInputChangeValueAttr,['style' =>'width:100%','data-href'=>$linkStatusOrder]))
            @endphp
            <tr>
                <td style="width: 3%">{{$index}}</td>
                <td style="width: 15%"><a href="{{route('backend.order.detail',$val['id'])}}">{{$val['code_order']}}</a></td>
                <td style="width: 17%" class="text-center">{{MyFunction::formatNumber($val['total'])}} đ</td>
                <td style="width: 20%" class="text-center">{{$val['buyer']['fullname']??''}}</td>
                <td style="width: 15%" class="text-center">{{$ngayDatHang}}</td>
                <td style="width:15%" class="font-weight-bold text-success text-center">
                    {!! $statusOrderValue[$val['status_order']]!!}
                </td>
                
                <td class='text-center'>
                    <a href="{{route('backend.order.detail',$val['id'])}}" class="btn btn-info btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Xem chi tiết đơn hàng"><i class="fas fa-eye rounded-circle"></i></a>
                </td>
            </tr>
        @endforeach
        @else
            @include("$moduleName.blocks.list_empty", ['colspan' => 8])
        @endif
    </tbody>
</table>
</div>
    