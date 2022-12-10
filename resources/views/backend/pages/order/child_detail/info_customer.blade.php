@php
use App\Model\OrderModel;
$params['id']= $id;
$item= (new OrderModel())->getItem($params,['task' => 'get-item']);
@endphp
<div class="card card-info">
    @include("$moduleName.blocks.x_title", ['title' => 'Thông tin khách hàng'])
    <div class="card-body p-0">
        <div class="set-withscreen">
            <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
                <thead>
                    <tr>
                        <th class="text-center">Họ và tên</th>
                        <th class="text-center">Số điện thoại</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Địa chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td style="width: 20%">{{$item['buyer']['fullname']}}</td>
                        <td style="width: 20%">{{$item['buyer']['phone']}}</td>
                        <td style="width: 20%">{{$item['buyer']['email']}}</td>
                        <td style="width: 40%">{{$item['buyer']['address']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>