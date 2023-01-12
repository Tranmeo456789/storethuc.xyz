@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;
    use App\Role;

    $label = config('myconfig.template.label');
    $formLabelAttr = MyFunction::array_fill_muti_values(array_merge_recursive(config('myconfig.template.form_element.label'),['class' => 'col-12 ']));
    $formSelect2Attr = config('myconfig.template.form_element.select2');

    $itemsRole = (new Role())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
    
    $formInputAttr = config('myconfig.template.form_element.input');
    $formEditorAttr = config('myconfig.template.form_element.editor');
    $star = config('myconfig.template.star');
    $formInputWidth['widthInput'] = 'col-12';
    $inputHiddenID = Form::hidden('id', $item['id']??null);
    $inputFileDel = isset($item['id'])?Form::hidden('file-del'):'';

$elements = [
    [
    'label' => HTML::decode(Form::label('name', 'Họ và tên' . $star, $formLabelAttr)),
    'element' => Form::text('name', $item['name']??null, array_merge($formInputAttr,['placeholder'=>'Họ và tên'])),
    'widthElement' => 'col-12'
    ]
];

$arrStatusPage = config('myconfig.template.status_user');
foreach($arrStatusPage as $key => $val){
$elements[] = [
    'label' => Form::label('name', $val, $formLabelAttr),
    'element' => Form::radio('status_user', $key, $key=='kich_hoat'?'true':'' ,array_merge($formInputAttr)),
    'type' =>'inline-text-right',
    'widthElement' => 'col-6',
    'styleFormGroup' => 'mb-2 h-35 label-radio',
];
}
$elements = array_merge($elements,
    [
        [
        'label' => HTML::decode(Form::label('email', 'Email' . $star, $formLabelAttr)),
        'element' => Form::text('email', $item['email']??null, array_merge($formInputAttr,['placeholder'=>'Email'])),
        'widthElement' => 'col-12'
        ],
        [
            'label'   => HTML::decode(Form::label('password', 'Mật khẩu mới' .  $star, $formLabelAttr)),
            'element' => Form::password('password', array_merge($formInputAttr,['placeholder'=>'Nhập Mật khẩu mới','style'=>'border-right:0px'])),
            'type' => 'input-password',
            'widthElement' => 'col-12 mb-2'
        ],[
            'label'   => HTML::decode(Form::label('password_confirmation', 'Nhập lại Mật khẩu mới' .  $star, $formLabelAttr)),
            'element' => Form::password('password_confirmation', array_merge($formInputAttr,['placeholder'=>'Nhập lại Mật khẩu mới','style'=>'border-right:0px'])),
            'type' => 'input-password',
            'widthElement' => 'col-12'
        ],
        [
            'label' => HTML::decode(Form::label('role_id', $label['role_id'] , $formLabelAttr)),
            'element' => Form::select('role_id',$itemsRole, $roleIdOfUser??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-12'
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