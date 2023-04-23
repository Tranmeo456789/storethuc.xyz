@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\MyFunction;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = MyFunction::array_fill_muti_values(array_merge_recursive(
                            config('myconfig.template.form_element.label'),
                            ['class' => 'col-12 ']));
    $formInputAttr    = config('myconfig.template.form_element.input');
    $formNumberAttr    = config('myconfig.template.form_element.input_number');
    $formSelect2Attr  = config('myconfig.template.form_element.select2');
    $formDateMaskAttr = config('myconfig.template.form_element.input_datemask');
    $star             = config('myconfig.template.star');
    $inputHiddenID    = Form::hidden('id', $item['id']??null);
    $date             = isset($item['date'])?MyFunction::formatDateFrontend($item['date']):'';
    $warehouse        = (count($itemsWareHouse) > 1)?[null=>"-- Chọn {$label['warehouse_id']} --"] +  $itemsWareHouse:$itemsWareHouse;
    $date  = isset($item['date'])?MyFunction::formatDateFrontend($item['date']):'';
    $linkGetProduct = route('product.getItem',['id' => 'value_new']);
    $formInputWidth['widthInput']  =  'col-12';
    $elements = [
        [
            'label'   => HTML::decode(Form::label('name', 'Mã phiếu nhập hàng' .  $star, $formLabelAttr)),
            'element' => Form::text('name', $item['name']??null, array_merge($formInputAttr,['placeholder'=>'Mã phiếu nhập hàng','readonly'=>true])),
            'widthElement' => 'col-4'
        ],[
            'label'   => HTML::decode(Form::label('date', 'Ngày nhập hàng' .  $star, $formLabelAttr)),
            'element' => Form::text('date', $date, array_merge($formDateMaskAttr,['placeholder'=>'Ngày nhập hàng'])),
            'widthElement' => 'col-4'
        ],[
            'label'   => HTML::decode(Form::label('warehouse_id', $label['warehouse_id']  .  $star, $formLabelAttr)),
            'element' => Form::select('warehouse_id',$warehouse,  $item['warehouse_id']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-4'
        ],[
            'label'   => HTML::decode(Form::label('', 'Chi tiết phiếu nhập'  .  $star, $formLabelAttr)),
            'element' => '',
            'widthElement' => 'col-12'
        ],[
            'label'   => HTML::decode(Form::label('', 'Tên sản phẩm', $formLabelAttr)),
            'element' => '',
            'widthElement' => 'col-4 p-0 text-center'
        ],[
            'label'   => HTML::decode(Form::label('', 'Đơn vị tính', $formLabelAttr)),
            'element' => '',
            'widthElement' => 'col-2 p-0 text-center'
        ],[
            'label'   => HTML::decode(Form::label('', 'Số lượng', $formLabelAttr)),
            'element' => '',
            'widthElement' => 'col-1 p-0 text-center'
        ],[
            'label'   => HTML::decode(Form::label('', 'Giá nhập', $formLabelAttr)),
            'element' => '',
            'widthElement' => 'col-2 p-0 text-center'
        ],[
            'label'   => HTML::decode(Form::label('', 'Thành tiền', $formLabelAttr)),
            'element' => '',
            'widthElement' => 'col-2 p-0 text-center'
        ],[
            'label'   => HTML::decode(Form::label('', '', $formLabelAttr)),
            'element' => '',
            'widthElement' => 'col-1 p-0 text-center'
        ]
    ];

    $elementsDetails = [];
    if (isset($item['list_products']) && (count($item['list_products']) > 0)) {
        foreach($item['list_products'] as $keyProduct => $product) {
            $elementsDetails[] = [
                [
                    'label'   => '',
                    'element' => Form::select('list_products[product_id][]',['null' => '-- Chọn sản phẩm -- '] + $itemsProduct,$product['product_id'], array_merge($formSelect2Attr,['style' =>'width:100%','data-href' => $linkGetProduct])),
                    'widthElement' => 'col-4'
                ],[
                    'label'   => '',
                    'element' => Form::select('list_products[unit_id][]',[$product['unit_id'] => $itemsUnit[$product['unit_id']]],$product['unit_id'], array_merge($formInputAttr,['style' =>'width:100%'])),
                    'widthElement' => 'col-2'
                ],[
                    'label'   => '',
                    'element' => Form::text('list_products[quantity][]', MyFunction::formatNumber($product['quantity']??0), array_merge($formNumberAttr,['placeholder'=>$label['quantity']])),
                    'widthElement' => 'col-1 text-right'
                ],[
                    'label'   => '',
                    'element' => Form::text('list_products[price_import][]', MyFunction::formatNumber($product['price_import']??0), array_merge($formNumberAttr,['placeholder'=>$label['price_import']])),
                    'widthElement' => 'col-2 text-right'
                ],[
                    'label'   => '',
                    'element' => Form::text('list_products[total_money][]', MyFunction::formatNumber($product['total_money']??0), array_merge($formNumberAttr,['placeholder'=>'Thành tiền','readonly'=>true])),
                    'widthElement' => 'col-2 text-right'
                ],[
                    'label'   => '',
                    'element' => Form::button("<i class='fa fa-plus'></i>",['class'=>'btn btn-sm btn-primary btn-add-row']) . " " . Form::button("<i class='fa fa-times'></i>",['class'=>'btn btn-sm btn-danger btn-delete-row']),
                    'widthElement' => 'col-1 text-right'
                ]
            ];
        }
    }else{
        $elementsDetails[] = [
            [
                'label'   => '',
                'element' => Form::select('list_products[product_id][]',['null' => '-- Chọn sản phẩm -- '] + $itemsProduct,null, array_merge($formSelect2Attr,['style' =>'width:100%','data-href' => $linkGetProduct])),
                'widthElement' => 'col-4'
            ],[
                'label'   => '',
                'element' => Form::select('list_products[unit_id][]',['null' => '-- Chọn đơn vị -- '],null, array_merge($formInputAttr,['style' =>'width:100%'])),
                'widthElement' => 'col-2'
            ],[
                'label'   => '',
                'element' => Form::text('list_products[quantity][]', 0, array_merge($formNumberAttr,['placeholder'=>$label['quantity']])),
                'widthElement' => 'col-1 text-right'
            ],[
                'label'   => '',
                'element' => Form::text('list_products[price_import][]', 0, array_merge($formNumberAttr,['placeholder'=>$label['price_import']])),
                'widthElement' => 'col-2 text-right'
            ],[
                'label'   => '',
                'element' => Form::text('list_products[total_money][]', 0, array_merge($formNumberAttr,['placeholder'=>'Thành tiền','readonly'=>true])),
                'widthElement' => 'col-2 text-right'
            ],[
                'label'   => '',
                'element' => Form::button("<i class='fa fa-plus'></i>",['class'=>'btn btn-sm btn-primary btn-add-row']) . " " . Form::button("<i class='fa fa-times'></i>",['class'=>'btn btn-sm btn-danger btn-delete-row']),
                'widthElement' => 'col-1 text-right'
            ]
        ];
    }

    $elementsDetails[] = [
            [
                'label'   => HTML::decode(Form::label('', 'Tổng tiền', $formLabelAttr)),
                'element' => '',
                'widthElement' => 'col-9 text-center'
            ],[
                'label'   => '',
                'element' => Form::text('total', MyFunction::formatNumber($item['total']??0), array_merge($formInputAttr,['placeholder'=>'Tổng tiền','readonly'=>true])),
                'widthElement' => 'col-2 text-right'
            ],[
                'label'   => '',
                'element' => '',
                'widthElement' => 'col-1 text-right'
            ]
    ];
    $elementsBtn  = [
            [
            'element' => $inputHiddenID .Form::submit('Lưu', ['class'=>'btn btn-primary']),
            'type'    => "btn-submit-center"
        ]
    ];
    $title = (!isset($item['id']) || $item['id'] == '')  ?'Thêm mới':'Sửa thông tin';
@endphp
@extends('layouts.backend')
@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false])
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => $title])
                    <div class="card-body">
                        {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("$controllerName.save"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'id'             => 'main-form' ])  }}
                            <div class="row">
                                {!! FormTemplate::show($elements,$formInputWidth)  !!}
                            </div>
                            @foreach($elementsDetails as $element)
                                <div class="row row-detail">
                                    {!! FormTemplate::show($element,$formInputWidth)  !!}
                                </div>
                            @endforeach
                            <div class="row">
                                {!! FormTemplate::show($elementsBtn,$formInputWidth)  !!}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection