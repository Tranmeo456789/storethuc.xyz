@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template as Template;
use App\Helpers\MyFunction;
$label = config('myconfig.template.label');
$formLabelAttr = MyFunction::array_fill_muti_values(array_merge_recursive(
    config('myconfig.template.form_element.label'),
['class' => 'col-12 ']));

$formInputAttr = config('myconfig.template.form_element.input');
$formEditorAttr = config('myconfig.template.form_element.editor');
$star = config('myconfig.template.star');
$formInputWidth['widthInput'] = 'col-12';
$inputHiddenID = Form::hidden('id', $item['id']??null);
$inputFileDel = isset($item['id'])?Form::hidden('file-del'):'';
$formSelect2Attr = config('myconfig.template.form_element.select2');
$itemsTypeProduct = config('myconfig.template.type_product');

$imageSelect= isset($item['thumbnail'])?sprintf(asset($item['thumbnail'])):'';
if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
$assetImg= sprintf(asset('uploads/images/product//'));
$nameImg= sprintf('/'.$_FILES['file']['name']);
$imageSelect= $assetImg.$nameImg;
};

$elements = [
        [
            'label' => HTML::decode(Form::label('name', 'Tên sản phẩm:' . $star, $formLabelAttr)),
            'element' => Form::text('name', $item['name']??null, array_merge($formInputAttr,['placeholder'=>'Tên sản phẩm'])),
            'widthElement' => 'col-12'
        ],[
            'label' => HTML::decode(Form::label('cat_id', $label['cat_id'].':' . $star , $formLabelAttr)),
            'element' => Form::select('cat_id',$itemsCatProduct, $item['cat_id']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-md-6 col-12'
        ],[
        'label' => HTML::decode(Form::label('unit_id', $label['unit_id'].':' . $star , $formLabelAttr)),
        'element' => Form::select('unit_id',$itemsUnit, $item['unit_id']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
        'widthElement' => 'col-md-6 col-12'
        ],
    ];

    $elements = array_merge($elements,
    [
        [
        'label' => HTML::decode(Form::label('price',$label['price'].':' . $star, $formLabelAttr)),
        'element' => Form::text('price', $item['price']??null, array_merge($formInputAttr,['placeholder'=>$label['price']])),
        'widthElement' => 'col-md-6 col-12'
        ],[
        'label' => HTML::decode(Form::label('promotion',$label['promotion'].':' . $star, $formLabelAttr)),
        'element' => Form::text('promotion', $item['promotion']??0, array_merge($formInputAttr,['placeholder'=>$label['promotion']])),
        'widthElement' => 'col-md-6 col-12'
        ]       
    ]);
    $arrStatusProduct = config('myconfig.template.status_product');
    foreach($arrStatusProduct as $key => $val){
            $elements[] = [
            'label' => Form::label('name', $val, $formLabelAttr),
            'element' => Form::radio('status_product', $key, $key=='con_hang'?'true':'' ,array_merge($formInputAttr)),
            'type' =>'inline-text-right',
            'widthElement' => 'col-6',
            'styleFormGroup' => 'mb-2 h-35 label-radio',
        ];
    }
    $elements = array_merge($elements,
    [
        [
            'label' => '',
            'element' =>'',
            'widthElement' => 'col-12',
        ],
        [
            'label' => HTML::decode(Form::label('thumbnail', $label['thumbnail'].':' . $star , $formLabelAttr)),
            'element' =>'',
            'widthElement' => 'col-12',
        ],
        [
            'label' => Form::label('file','Chọn ảnh từ máy', ['class' => "col-12 col-form-label btn btn-primary"]),
            'element' => Form::file('file',['class' => "form-control-file",'onchange'=>'show_upload_image()']),
            'imageSelect' => $imageSelect,
            'widthElement' => 'col-12',
            'widthInput' => 'col-11',
            'type'=>'input-file-show',
        ],
        [
            'label' => Form::label('describe', $label['describe'].':', $formLabelAttr),
            'element' => Form::textarea('describe', $item['describe']?? null, array_merge($formInputAttr,['placeholder'=>$label['describe'],"rows"=>"5"]))
        ],
        [
            'label' => Form::label('content', $label['content'].':', $formLabelAttr),
            'element' => Form::textarea('content', $item['content']?? null, array_merge($formEditorAttr,['placeholder'=>$label['content'],'id'=>'content']))
        ],
        [
            'element' => $inputHiddenID . $inputFileDel .Form::submit('Lưu', ['class'=>'btn btn-primary']),
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
    <div class="">
        <div class="card card-primary">
            @include("$moduleName.blocks.x_title", ['title' => $title])
            <div class="card-body">
                {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("$controllerName.save"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'enctype'        => 'multipart/form-data',
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