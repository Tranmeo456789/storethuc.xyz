@php
    use App\Helpers\Form as FormTemplate;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = config('myconfig.template.form_element.label');
    $formInputAttr    = config('myconfig.template.form_element.input');
    $star             = config('myconfig.template.star');
    $formInputWidth['widthInput']  =  'col-12 p-0';
    $inputHiddenID    = Form::hidden('id', $item['id']??null);
    $elements = [
        [
            'label'   => HTML::decode(Form::label('name', 'Tên màu' .  $star, $formLabelAttr)),
            'element' => Form::text('name', $item['name']??null, array_merge($formInputAttr,['placeholder'=>'Tên màu'])),
            'widthElement' => 'col-12'
        ],
        [
            'label'   => HTML::decode(Form::label('code', 'Chọn màu' .  $star, $formLabelAttr)),
            'element' => Form::input('color', 'code', $item['code']??'#000000', array('class' => 'col-12','id'=>'colorpicker')),
            'widthElement' => 'col-12'
        ],
        [
            'label'   => HTML::decode(Form::label('show_code', 'Mã màu', $formLabelAttr)),
            'element' => Form::text('show_code', $item['code']??'#000000', ['id'=>'hexcolor','class'=>'form-control text-center text-uppercase', 'disabled' => 'disabled']),
            'widthElement' => 'col-12'
        ],
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
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => $title])
                    <div class="card-body">
                        {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("$controllerName.save"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'id'             => 'main-form' ])  }}

                            {!! FormTemplate::show($elements,$formInputWidth)  !!}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection