@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;

    $label = config('myconfig.template.label');
    $formLabelAttr = MyFunction::array_fill_muti_values(array_merge_recursive(config('myconfig.template.form_element.label'),['class' => 'col-12 ']));

    $formInputAttr = config('myconfig.template.form_element.input');
    $formEditorAttr = config('myconfig.template.form_element.editor');
    $star = config('myconfig.template.star');
    $formInputWidth['widthInput'] = 'col-12';
    $inputHiddenID = Form::hidden('id', $item['id']??null);
    $inputFileDel = isset($item['id'])?Form::hidden('file-del'):'';

$elements = [
    [
    'label' => HTML::decode(Form::label('name', 'Tiêu đề trang:' . $star, $formLabelAttr)),
    'element' => Form::text('name', $item['name']??null, array_merge($formInputAttr,['placeholder'=>'Tiêu đề trang'])),
    'widthElement' => 'col-12'
    ]
];

$arrStatusPage = config('myconfig.template.status_page');
foreach($arrStatusPage as $key => $val){
$elements[] = [
    'label' => Form::label('name', $val, $formLabelAttr),
    'element' => Form::radio('status_page', $key, $key=='cong_khai'?'true':'' ,array_merge($formInputAttr)),
    'type' =>'inline-text-right',
    'widthElement' => 'col-6',
    'styleFormGroup' => 'mb-2 h-35 label-radio',
];
}
$elements = array_merge($elements,
    [
        [
        'label' => Form::label('content', $label['content'].':', $formLabelAttr),
        'element' => Form::textarea('content', $item['content']?? null, array_merge($formEditorAttr,['placeholder'=>$label['content'],'id'=>'content']))
        ],
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