@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;

    $label = config('myconfig.template.label');
    $formLabelAttr = MyFunction::array_fill_muti_values(array_merge_recursive(config('myconfig.template.form_element.label'),['class' => 'col-12 ']));

    $formInputAttr = config('myconfig.template.form_element.input');
    
    $imageSelect= isset($item['image'])?sprintf(asset($item['image'])):'';
    if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
    $assetImg= sprintf(asset('uploads/images/slider//'));
    $nameImg= sprintf('/'.$_FILES['file']['name']);
    $imageSelect= $assetImg.$nameImg;}

    $star = config('myconfig.template.star');
    $formInputWidth['widthInput'] = 'col-12';
    $inputHiddenID = Form::hidden('id', $item['id']??null);
    $inputFileDel = isset($item['id'])?Form::hidden('file-del'):'';

$elements = [
    [
    'label' => HTML::decode(Form::label('link', 'Link cho slider' . $star, $formLabelAttr)),
    'element' => Form::text('link', $item['link']??null, array_merge($formInputAttr,['placeholder'=>'Nhập link liên kết'])),
    'widthElement' => 'col-12'
    ],
    [
            'label' => Form::label('file','Chọn ảnh cho slider', ['class' => "col-12 col-form-label btn btn-primary"]),
            'element' => Form::file('file',['class' => "form-control-file",'onchange'=>'show_upload_image()']),
            'imageSelect' => $imageSelect,
            'widthElement' => 'col-12',
            'widthInput' => 'col-11',
            'type'=>'input-file-show',
        ]
];

$arrStatusPage = config('myconfig.template.status_slider');
foreach($arrStatusPage as $key => $val){
$elements[] = [
    'label' => Form::label('name', $val, $formLabelAttr),
    'element' => Form::radio('status_slider', $key, $key=='cong_khai'?'true':'' ,array_merge($formInputAttr)),
    'type' =>'inline-text-right',
    'widthElement' => 'col-6',
    'styleFormGroup' => 'mb-2 h-35 label-radio',
];
}
$elements = array_merge($elements,
    [
        [
        'element' => $inputHiddenID . $inputFileDel .Form::submit('Lưu', ['class'=>'btn btn-primary']),
        'type' => "btn-submit-center"
        ]
    ]
);
$title = (!isset($item['id']) || $item['id'] == '') ?'Thêm mới':'Sửa thông tin';
@endphp
@extends('layouts.backend')
@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false])
<section class="content">
    <div class="">
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
                    {!! FormTemplate::show($elements,$formInputWidth) !!}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@endsection