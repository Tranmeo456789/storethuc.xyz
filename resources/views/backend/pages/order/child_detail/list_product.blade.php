@php
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;
@endphp
<div class="card card-info">
    @include("$moduleName.blocks.x_title", ['title' => 'Sản phẩm đã đặt'])
    <div class="card-body p-0">
        <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
            <thead>
                <tr >
                    <th class="text-center">STT</th>
                    <th class="text-center">Tên sản phẩm</th>
                    <th class="text-center">Giá</th>
                    <th class="text-center">Đơn vị tính</th>
                    <th class="text-center">Số lượng đặt</th>
                    <th class="text-center">Số lượng giao</th>
                    <th class="text-center">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 0;

                    $arrProduct = array_column($itemsProduct->toArray(),'id');
                @endphp
                @foreach($item as $val)
                    @php
                        $index++;
                        $image = Template::showImagePreviewFileManager($val['image'],$val['slug']??$val['name']);
                        $price = MyFunction::formatNumber($val['price']) . ' đ';
                        $total_money = MyFunction::formatNumber($val['total_money']) . ' đ';
                        $pos = array_search($val['product_id'],$arrProduct);
                        $code = $itemsProduct[$pos]['code'];
                        $unit = $itemsProduct[$pos]->unitProduct->name;
                    @endphp

                    <tr>
                        <td style="width: 3%">{{$index}}</td>
                        <td style="width: 35%" class="img-in-table">
                            <div class="d-flex">
                                <div class="align-items-center"  style="width:15%">
                                    {!! $image !!}
                                </div>
                                <div class="info-product ml-1">
                                    <p class="text-primary font-weight-bold mb-1">{{$val['name']}}</p>
                                    <p mb-1>Mã: {{$code}}</p>
                                </div>
                            </div>
                        </td>
                        <td style="width: 7%" class="text-right">{{$price}}</td>
                        <td style="width: 7%" class="text-center">{{$unit}}</td>
                        <td style="width: 5%" class="text-right">{{$val['quantity']}}</span></td>
                        <td style="width: 5%" class="text-right">{{$val['quantity']}}</span></td>
                        <td style="width: 8%" class="text-right"> {{$total_money}} </td>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>