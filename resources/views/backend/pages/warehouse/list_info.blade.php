@php
    use App\Helpers\Template;
@endphp
<table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
    <thead>
        <tr class="row-heading">
            <th>STT</th>
            <th>Sản phẩm</th>
            @foreach($itemsWarehouses as $warehouse)
            <th>{{$warehouse}}</th>
            @endforeach
            <th>SL tổng</th>
        </tr>
    </thead>
    @php
        $temp=0;
    @endphp
    <tbody>
        @if (count($itemsProduct) > 0)
            @foreach ($itemsProduct as $val)
                @php
                    $temp++;
                    $image = Template::showImagePreviewFileManager($val['thumbnail'],$val['slug']??$val['name']);
                    $detail = $val->productWarehouse->pluck('quantity', 'warehouse_id')->toArray();
                @endphp
                <tr>
                    <td style="width:20px !important">{{$temp}}</td>
                    <td style="width: 60%" class='name img-in-table'>
                        <div class="d-flex">
                            <div class="align-items-center"  style="width:15%">
                                <div class="ht-100">{!! $image !!}</div>
                            </div>
                            <div class="info-product ml-2">
                                <p class="text-success font-weight-bold mb-1">{{$val->name}}</p>
                            </div>
                        </div>
                    </td>
                    @foreach($itemsWarehouses as $keyWarehouse => $valWarehouse)
                    <td class="text-center">{{ $detail[$keyWarehouse]??0 }}</td>
                    @endforeach
                    <td style="width: 10%" class="text-center">{{$val->quantity_in_stock??0}}</td>
                </tr>
            @endforeach
        @else
            @include("$moduleName.blocks.list_empty", ['colspan' => 6])
        @endif
    </tbody>
</table>