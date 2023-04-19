@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\MyFunction;

$label = config('myconfig.template.label');
$formLabelAttr = MyFunction::array_fill_muti_values(array_merge_recursive(
    config('myconfig.template.form_element.label'),
['class' => 'col-12 ']));

$formInputAttr = config('myconfig.template.form_element.input');

$formSelect2Attr = config('myconfig.template.form_element.select2');
$formSelect2GetChildAttr = array_merge_recursive(
                                    config('myconfig.template.form_element.select2'),
                                    config('myconfig.template.form_element.get_child')
                                    );
$formSelect2GetChildAttr = MyFunction::array_fill_muti_values($formSelect2GetChildAttr);
$formSelect2GetDataAttr = array_merge_recursive(
                                    config('myconfig.template.form_element.select2'),
                                    config('myconfig.template.form_element.get_data')
                                    );
$formSelect2GetDataAttr = MyFunction::array_fill_muti_values($formSelect2GetDataAttr);
$linkGetListDistrict = route('district.getListByParentID',['parentID' => 'value_new']);
$linkGetListWard = route('ward.getListByParentID',['parentID' => 'value_new']);
$formSelect2GetChildIgnoreAttr    = array_merge_recursive(
                                        $formSelect2GetChildAttr,
                                    ['class' => '']
                                    );
$formSelect2GetChildIgnoreAttr = MyFunction::array_fill_muti_values($formSelect2GetChildIgnoreAttr);

$star = config('myconfig.template.star');
$formInputWidth['widthInput'] = 'col-12';
$inputHiddenID = Form::hidden('id', $item['id']??null);
if(!isset($item['id']) || $item['id'] != 1){
    $elements=[
            [
                'label'   => HTML::decode(Form::label('province_id', 'Chọn tỉnh, thành phố' . $star, $formLabelAttr)),
                'element' => Form::select('province_id',[null=>"-- Chọn {$label['province_id']} --"] + $itemsProvince, $item['province_id']??($item['province_id']??null), array_merge($formSelect2GetChildAttr,['id' =>'item[province_id]','style' =>'width:100%','data-href'=>$linkGetListDistrict,'data-target' => '#district_id'])),
                'widthElement' => 'col-lg-6 col-md-12',
                
            ],[
                'label'   => HTML::decode(Form::label('district_id', 'Chọn quận, huyện' . $star, $formLabelAttr)),
                'element' => Form::select('district_id',[null=>"-- Chọn {$label['district_id']} --"] + $itemsDistrict, $item['district_id']??($item['district_id']??null), array_merge($formSelect2GetChildIgnoreAttr,['id' =>'district_id','data-href'=>$linkGetListWard,'data-target' => '#ward_id','style' =>'width:100%'])),
                'widthElement' => 'col-lg-6 col-md-12',
                
            ],[
                'label'   => HTML::decode(Form::label('item[ward_id]', $label['ward_id']  .  $star, $formLabelAttr)),
                'element' => Form::select('ward_id',[null=>"-- Chọn {$label['ward_id']} --"] +  $itemsWard,  $item['ward_id']??($item['ward_id']??null), array_merge($formSelect2Attr,['id' =>'ward_id','style' =>'width:100%'])),
                'widthElement' => 'col-lg-6 col-md-12'
            ],
        ];
}else{
    $elements=[
            [
                'label'   => HTML::decode(Form::label('', 'Địa điểm toàn quốc', $formLabelAttr)),
                'element' => '',
                'widthElement' => 'col-12',
            ],
        ];
}
$elements = array_merge($elements,
    [
            [
            'label' => HTML::decode(Form::label('fee_ship', 'Tiền phí ship' . $star, $formLabelAttr)),
            'element' => Form::text('fee_ship', $item['fee_ship']??null, array_merge($formInputAttr,['placeholder'=>'Tiền phí ship'])),
            'widthElement' => 'col-lg-6 col-md-12'
        ],[
            'element' => $inputHiddenID .Form::submit('Lưu', ['class'=>'btn btn-primary']),
            'type' => "btn-submit-center"
        ]      
    ]);


$title = (!isset($item['id']) || $item['id'] == '') ?'Thêm mới':'Sửa thông tin';
@endphp
@extends('layouts.backend')
@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false])
<section class="content">
    <div class="card card-primary">
        @include("$moduleName.blocks.x_title", ['title' => $title])
        <div class="card-body">
            {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("$controllerName.save"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'id'             => 'main-form' ])  }}

            <div class="container">
                <div class="row">               
                    {!! FormTemplate::show($elements,$formInputWidth) !!}
                 </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>

</section>
@endsection