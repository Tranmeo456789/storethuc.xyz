@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = MyFunction::array_fill_muti_values(array_merge_recursive(
                            config('myconfig.template.form_element.label'),
                            ['class' => 'col-12 ']));
    $formInputAttr    = config('myconfig.template.form_element.input');
    $formInputWidth['widthInput']  =  'col-12';
    $inputHiddenID    = Form::hidden('id', $item['id']??null);
    $formSelect2Attr  = config('myconfig.template.form_element.select2');
    $statusOrderValue = array_combine(array_keys(config("myconfig.template.column.status_order")),array_column(config("myconfig.template.column.status_order"),'name'));
    unset($statusOrderValue['all']);
    $ngayDatHang = MyFunction::formatDateFrontend($item['created_at']);

    $linkServiceArr = array_combine(array_keys(config("myconfig.template.column.delivery_service")),array_column(config("myconfig.template.column.delivery_service"),'link'));
    $linkService= isset($linkServiceArr[$item['delivery_service']]) ? $linkServiceArr[$item['delivery_service']].$item['code_service'] : '';
    
    $deliveryService=array_combine(array_keys(config("myconfig.template.column.delivery_service")),array_column(config("myconfig.template.column.delivery_service"),'name'));
    $elements = [
        [
            'label'   => HTML::decode(Form::label('code_order', $label['code_order'], $formLabelAttr)),
            'element' => Form::text('code_order', $item['code_order']??null, array_merge($formInputAttr,['placeholder'=>$label['code_order'],'readonly' =>true])),
            'widthElement' => 'col-md-6 col-12'
        ],[
            'label'   => HTML::decode(Form::label('', $label['status_order'], $formLabelAttr)),
            'element' => Form::select('status_order',$statusOrderValue, $item['status_order']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-md-6 col-12'
        ],[
            'label'   => HTML::decode(Form::label('total', 'Tổng tiền đơn hàng' , $formLabelAttr)),
            'element' => Form::text('total', MyFunction::formatNumber($item['total']??0) . 'đ', array_merge($formInputAttr,['readonly' =>true,'style'=>'text-align:right'])),
            'widthElement' => 'col-md-6 col-12'
        ],
        [
            'label'   => HTML::decode(Form::label('total', 'Phí vận chuyển' , $formLabelAttr)),
            'element' => Form::text('total', MyFunction::formatNumber($item['value_fee_ship']??0) . 'đ', array_merge($formInputAttr,['readonly' =>true,'style'=>'text-align:right'])),
            'widthElement' => 'col-md-6 col-12'
        ],
        [
            'label'   => HTML::decode(Form::label('total_product', 'Số lượng sản phẩm', $formLabelAttr)),
            'element' => Form::text('total_product', $item['total_product']??null, array_merge($formInputAttr,['readonly' =>true])),
            'widthElement' => 'col-md-4 col-12'
        ],[
            'label'   => HTML::decode(Form::label('', 'Số lượng mặt hàng', $formLabelAttr)),
            'element' => Form::text('', count($item['info_product']??[]), array_merge($formInputAttr,['readonly' =>true])),
            'widthElement' => 'col-md-4 col-12'
        ],[
            'label'   => HTML::decode(Form::label('', 'Hình thức thanh toán', $formLabelAttr)),
            'element' => Form::text('', 'Thanh toán tại nhà', array_merge($formInputAttr,['readonly' =>true])),
            'widthElement' => 'col-md-4 col-12'
        ],[
            'label'   => HTML::decode(Form::label('', $label['delivery_service'], $formLabelAttr)),
            'element' => Form::select('delivery_service',$deliveryService, $item['delivery_service']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-md-4 col-12'
        ],
        [
            'label'   => HTML::decode(Form::label('', 'Mã Bill dịch vụ(điền chính xác mã)', $formLabelAttr)),
            'element' => Form::text('code_service', $item['code_service']??'', array_merge($formInputAttr,['readonly' =>false])),
            'widthElement' => 'col-md-4 col-12'
        ],
        [
            'label'   => HTML::decode(Form::label('', 'Thời gian đặt hàng', $formLabelAttr)),
            'element' => Form::text('', $ngayDatHang, array_merge($formInputAttr,['readonly' =>true])),
            'widthElement' => 'col-md-4 col-12'
        ],
        [
            'widthElement' => 'col-12',
            'linkService' => $linkService,
            'type'    => "tag-a-link-service",
        ],
        [
            'element' => $inputHiddenID  .Form::submit('Cập nhật', ['class'=>'btn btn-primary']),
            'type'    => "btn-submit-center"
        ]
    ];


@endphp
@extends('layouts.backend')
@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false])
@include("$moduleName.blocks.notify")
<section class="content">
            <div class="">
                <div class="card card-info">
                    @include("$moduleName.blocks.x_title", ['title' => 'Thông tin đơn hàng'])
                    <div class="card-body">
                        {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("$controllerName.changeStatusOrder"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'enctype'        => 'multipart/form-data',
                            'id'             => 'main-form' ])  }}
                            <div class="row">
                                {!! FormTemplate::show($elements,$formInputWidth)  !!}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="">
                @include("$moduleName.pages.$controllerName.child_detail.info_customer",['item' => $item->userBuy])
            </div>
            <div class="">
                @include("$moduleName.pages.$controllerName.child_detail.list_product",['item' => $item['info_product']])
            </div>
        
</section>

@endsection