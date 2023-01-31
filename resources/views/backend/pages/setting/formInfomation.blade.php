@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;
    use App\Model\ColorModel;

    $label = config('myconfig.template.label');
    $formLabelAttr = MyFunction::array_fill_muti_values(array_merge_recursive(config('myconfig.template.form_element.label'),['class' => 'col-12 ']));
    $formSelect2Attr = config('myconfig.template.form_element.select2');

    $formInputAttr = config('myconfig.template.form_element.input');
    $formEditorAttr = config('myconfig.template.form_element.editor');
    $star = config('myconfig.template.star');
    $formInputWidth['widthInput'] = 'col-12';
    $inputHiddenID = Form::hidden('id', $item['id']??null);
    $inputFileDel = isset($item['id'])?Form::hidden('file-del'):'';

    $itemsColor = (new ColorModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);

$elements = [
    [
    'label' => HTML::decode(Form::label('name', 'Tên theme' . $star, $formLabelAttr)),
    'element' => Form::text('name', $item['name']??null, array_merge($formInputAttr,['placeholder'=>'Tên theme'])),
    'widthElement' => 'col-12'
    ],
    [
    'label' => HTML::decode(Form::label('phone', 'Số điện thoại' . $star, $formLabelAttr)),
    'element' => Form::text('phone', $item['phone']??null, array_merge($formInputAttr,['placeholder'=>'Số điện thoại'])),
    'widthElement' => 'col-12'
    ],
    [
    'label' => HTML::decode(Form::label('address', 'Địa chỉ store' . $star, $formLabelAttr)),
    'element' => Form::text('address', $item['address']??null, array_merge($formInputAttr,['placeholder'=>'Địa chỉ store'])),
    'widthElement' => 'col-12'
    ],
    [
        'label' => HTML::decode(Form::label('color_bg_header', 'Màu nền phần đầu web'.$star , $formLabelAttr)),
        'element' => Form::select('color_bg_header',$itemsColor, $item['color_bg_header']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
        'widthElement' => 'col-12 wp-select-color'
    ],
    [
        'label'   => '',
        'element' => Form::text('show_color_1', null, ['class'=>'form-control', 'disabled' => 'disabled','style'=>"background-color : $item->color_bg_header"]),
        'widthElement' => 'col-12'
    ],
    [
        'label' => HTML::decode(Form::label('color_bg_body', 'Màu nền phần thân web'.$star , $formLabelAttr)),
        'element' => Form::select('color_bg_body',$itemsColor, $item['color_bg_body']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
        'widthElement' => 'col-12 wp-select-color'
    ],
    [
        'label'   => '',
        'element' => Form::text('show_color_2', null, ['class'=>'form-control', 'disabled' => 'disabled','style'=>"background-color : $item->color_bg_body"]),
        'widthElement' => 'col-12'
    ]
];
$elements = array_merge($elements,
    [
        [
        'element' => $inputHiddenID . $inputFileDel .Form::submit('Cập nhật', ['class'=>'btn btn-primary']),
        'type' => "btn-submit-center"
        ]
    ]
);

$title = 'Thông tin trang chủ';
@endphp
@extends('layouts.backend')
@section('title',$pageTitle)
@section('content')

@include("$moduleName.blocks.notify")
<section class="content">
    <div class="">
        <div class="card card-primary">
            @include("$moduleName.blocks.x_title", ['title' => $title])
            @if (Session::has('test'))
            <strong>
                @php
                 dd(session('test')); 
                @endphp
                </strong>
                @endif
            <div class="card-body">
                {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("$controllerName.infomation.save"),
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