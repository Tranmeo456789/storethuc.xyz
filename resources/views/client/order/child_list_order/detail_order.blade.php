@php
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;
    use App\Model\UnitModel;
    use App\Model\OrderModel;
    $status_order=[
        ['temp'=>5,'name'=>'Hoàn tất','slug'=>'hoanTat'],
        ['temp'=>4,'name'=>'Đã giao hàng','slug'=>'daGiaoHang'],
        ['temp'=>3,'name'=>'Đang giao hàng','slug'=>'dangGiaoHang'],
        ['temp'=>2,'name'=>'Đã xác nhận','slug'=>'daXacNhan'],
        ['temp'=>1,'name'=>'Đang xử lý','slug'=>'dangXuLy'],
    ];  
@endphp
<div class="header d-flex justify-content-between">
    <div class="tshorder">Chi tiết đơn hàng</div>
    <button class="btn-closenk rimg-center"><img src="{{asset('images/dn4.png')}}" alt=""></button>
</div>
@if(isset($order_detail))
@php
$info_buyer=$order_detail['buyer'];
$ngayDatHang = MyFunction::formatDateFrontend($order_detail['created_at']);
foreach($status_order as $value){
    if($value['slug']==$order_detail['status_order']){
        $indexCurent=$value['temp'];
        break;
    }
}
@endphp
<div class="wp-content">
    <div class="top-tab-order">
        <h4 class="mb-0">Đơn hàng <span class="text-info">{{$order_detail['code_order']}}</span></h4>
        <p>Đặt hàng ngày {{$ngayDatHang}}</p>
    </div>
    <div class="tab-header">
        <p>Trạng thái đơn hàng</p>
    </div>
    <div class="wp-status-order">
        <ul class="ls-status-order">
            @foreach($status_order as $item)
            <li>
                <div class="d-flex">
                    <div class="stepper-circle">
                        <div class="{{$item['slug']==$order_detail['status_order']?'stepper-circle-icon':''}} {{$item['temp'] < $indexCurent?'stepper-circle-icon-old':''}}"></div>
                    </div>
                    <div class="stepper-label ml-2">{{$item['name']}}</div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-header">
        <p>Thông tin giao hàng</p>
    </div>
    <div class="item-info">
        <table class="table pd-order mb-0" id="tbList">
            <tbody>
                <tr class="bb_order">
                    <td style="width: 30%">Số đơn hàng</td>
                    <td style="width: 70%" class='name text-info'>{{$order_detail['code_order']}}</td>
                </tr>
                <tr class="bb_order">
                    <td style="width: 30%">Họ và tên</td>
                    <td style="width: 70%" class='name'>{{$info_buyer['fullname']}}</td>
                </tr>
                <tr class="bb_order pb-1">
                    <td style="width: 30%">Số điện thoại người đặt</td>
                    <td style="width: 70%" class='name'>{{$info_buyer['phone']}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tab-header">
        <p>Thông tin nhận hàng & thanh toán</p>
    </div>
    <div class="item-info">
        <table class="table pd-order mb-0" id="tbList">
            <tbody>
                <tr class="bb_order">
                    <td style="width: 30%">Họ và tên người nhận</td>
                    <td style="width: 70%">{{$info_buyer['fullname']}}</td>
                </tr>
                <tr class="bb_order">
                    <td style="width: 30%">Số điện thoại người nhận</td>
                    <td style="width: 70%" class='name'>{{$info_buyer['phone']}}</td>
                </tr>
                <tr class="bb_order pb-1">
                    <td style="width: 30%">Nhận hàng tại</td>
                    <td style="width: 70%" class='name'>{{$info_buyer['address']}}</td>
                </tr>
                <tr class="bb_order pb-1">
                    <td style="width: 30%">Phương thức thanh toán</td>
                    <td style="width: 70%" class='name'>Chưa thanh toán</td>
                </tr>
                <tr class="bb_order pb-1">
                    <td style="width: 30%">Thời gian dự kiến</td>
                    <td style="width: 70%" class='name'>.....</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="item-info px-0">
        <table class="table pd-order mb-0" id="tbList">
            <thead>
                <tr>
                    <th scope="col" colspan="2">Thông tin đơn hàng</th>
                    <th scope="col" class="d-none d-md-table-cell">Đơn vị</th>
                    <th scope="col" class="d-none d-md-table-cell">Số lượng</th>
                    <th scope="col" class="text-center">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 0;
                @endphp
                @foreach($order_detail['info_product'] as $val)
                @php
                    $index++;
                    $image = Template::showImagePreviewFileManager($val['image'],$val['slug']??$val['name']);
                    $price = MyFunction::formatNumber($val['price']) . ' đ';
                    $total_money = MyFunction::formatNumber($val['total_money']) . ' đ';
                    
                @endphp
                <tr class="bb_order">
                    <td style="width: 10%" class='name'>
                        {!! $image !!}
                    </td>
                    <td style="width: 40%">
                        <div>
                            <p class="namep-order truncate2">{{$val['name']}}</p>
                            <p class="namep-order d-block d-md-none">Đơn vị: {{$val['unit']}}</p>
                            <p class="namep-order d-block d-md-none">Số lượng: {{$val['quantity']}}</p>
                        </div>
                    </td>
                    <td style="width: 14%" class="d-none d-md-table-cell">{{$val['unit']}}</td>
                    <td style="width: 10%" class="d-none d-md-table-cell">{{$val['quantity']}}</td>
                    <td style="width: 20%" class="text-center font-md-14">{{$total_money}}</td>
                </tr>
                @endforeach
                
            </tbody>
            
        </table>
        <div class="money-order-detail">
            <ul>
                <li><div class="font-md-14 text-right">Phí vận chuyển: {{MyFunction::formatNumber($order_detail['value_fee_ship'])}} đ</div></li>
                <li><div class="font-md-14 text-right font-weight-bold">Cần thanh toán: {{MyFunction::formatNumber($order_detail['total'])}} đ</div></li>
            </ul>
        </div>
    </div>
</div>
@endif