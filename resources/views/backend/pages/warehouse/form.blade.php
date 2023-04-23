@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\MyFunction;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = array_merge_recursive(
                            config('myconfig.template.form_element.label'),
                            ['class' => 'col-12']
                        );
    $formLabelAttr = MyFunction::array_fill_muti_values($formLabelAttr);

    $formInputAttr    = config('myconfig.template.form_element.input');
    $formSelect2Attr  = config('myconfig.template.form_element.select2');
    $formSelect2GetChildAttr  = array_merge_recursive(
                                config('myconfig.template.form_element.select2'),
                                config('myconfig.template.form_element.get_child')
                            );
    $formSelect2GetChildAttr = MyFunction::array_fill_muti_values($formSelect2GetChildAttr);
    $star             = config('myconfig.template.star');
    $formInputWidth['widthInput']  =  'col-12';
    $inputHiddenID    = Form::hidden('id', $item['id']??null);

    $linkGetListDistrict = route('district.getListByParentID',['parentID' => 'value_new']);
    $linkGetListWard = route('ward.getListByParentID',['parentID' => 'value_new']);
    $elements = [
        [
            'label'   => HTML::decode(Form::label('name', 'Tên ' . $pageTitle .  $star, $formLabelAttr)),
            'element' => Form::text('name', $item['name']??null, array_merge($formInputAttr,['placeholder'=>'Tên ' . $pageTitle ])),
            'widthElement' => 'col-12'
        ],[
            'label'   => HTML::decode(Form::label('item[province_id]', $label['province_id']  .  $star, $formLabelAttr)),
            'element' => Form::select('province_id',[null=>"-- Chọn {$label['province_id']} --"] + $itemsProvince, $item['province_id']??($item['province_id']??null), array_merge($formSelect2GetChildAttr,['id' =>'item[province_id]','style' =>'width:100%','data-href'=>$linkGetListDistrict,'data-target' => '#district_id'])),
            'widthElement' => 'col-3'
        ],[
            'label'   => HTML::decode(Form::label('item[district_id]', $label['district_id']  .  $star, $formLabelAttr)),
            'element' => Form::select('district_id',[null=>"-- Chọn {$label['district_id']} --"] +  $itemsDistrict,  $item['district_id']??($item['district_id']??null), array_merge($formSelect2GetChildAttr,['id' =>'district_id','data-href'=>$linkGetListWard,'data-target' => '#ward_id','style' =>'width:100%'])),
            'widthElement' => 'col-3'
        ],[
            'label'   => HTML::decode(Form::label('item[ward_id]', $label['ward_id']  .  $star, $formLabelAttr)),
            'element' => Form::select('ward_id',[null=>"-- Chọn {$label['ward_id']} --"] +  $itemsWard,  $item['ward_id']??($item['ward_id']??null), array_merge($formSelect2Attr,['id' =>'ward_id','style' =>'width:100%'])),
            'widthElement' => 'col-3'
        ],[
            'label'   => HTML::decode(Form::label('local', $label['local'], $formLabelAttr)),
            'element' => Form::text('local', $item['local']??null, array_merge($formInputAttr,['placeholder'=>$label['local']])),
            'widthElement' => 'col-3'
        ],[
            'label'   => HTML::decode(Form::label('address', $label['address'], $formLabelAttr)),
            'element' => Form::text('address', $item['address']??null, array_merge($formInputAttr,['placeholder'=>$label['address'], 'readonly'=>true])),
            'widthElement' => 'col-12'
        ],[
            'element' => $inputHiddenID   .Form::submit('Cập nhật', ['class'=>'btn btn-primary']),
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
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection