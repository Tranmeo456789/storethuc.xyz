@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;

    use App\Model\CatPostModel;

    $label = config('myconfig.template.label');
    $formLabelAttr = MyFunction::array_fill_muti_values(array_merge_recursive(config('myconfig.template.form_element.label'),['class' => 'col-12 ']));
    $formSelect2Attr = config('myconfig.template.form_element.select2');

    $imageSelect= isset($item['thumbnail'])?sprintf(asset($item['thumbnail'])):'';
    if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
    $assetImg= sprintf(asset('uploads/images/post//'));
    $nameImg= sprintf('/'.$_FILES['file']['name']);
    $imageSelect= $assetImg.$nameImg;}

    $itemsCatPost = (new CatPostModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);

    $formInputAttr = config('myconfig.template.form_element.input');
    $formEditorAttr = config('myconfig.template.form_element.editor');
    $star = config('myconfig.template.star');
    $formInputWidth['widthInput'] = 'col-12';
    $inputHiddenID = Form::hidden('id', $item['id']??null);
    $inputFileDel = isset($item['id'])?Form::hidden('file-del'):'';

$elements = [
    [
    'label' => HTML::decode(Form::label('name', 'Tiêu đề bài viết' . $star, $formLabelAttr)),
    'element' => Form::text('name', $item['name']??null, array_merge($formInputAttr,['placeholder'=>'Tiêu đề bài viết'])),
    'widthElement' => 'col-12'
    ]
];

$arrStatusPost = config('myconfig.template.status_post');
foreach($arrStatusPost as $key => $val){
$elements[] = [
    'label' => Form::label('name', $val, $formLabelAttr),
    'element' => Form::radio('status_post', $key, $key=='cong_khai'?'true':'' ,array_merge($formInputAttr)),
    'type' =>'inline-text-right',
    'widthElement' => 'col-6',
    'styleFormGroup' => 'mb-2 h-35 label-radio',
];
}
$elements = array_merge($elements,
    [
        [
            'label' => Form::label('file','Chọn ảnh cho bài viết', ['class' => "col-12 col-form-label btn btn-primary"]),
            'element' => Form::file('file',['class' => "form-control-file",'onchange'=>'show_upload_image()']),
            'imageSelect' => $imageSelect,
            'widthElement' => 'col-12',
            'widthInput' => 'col-11',
            'type'=>'input-file-show',
        ],
        [
            'label' => HTML::decode(Form::label('cat_id', $label['cat_id'].$star , $formLabelAttr)),
            'element' => Form::select('cat_id',$itemsCatPost, $item['cat_id']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-md-4 col-12'
        ],
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