@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\MyFunction;
    $label = config('myconfig.template.label');
    $formLabelAttr    = config('myconfig.template.form_element.label');
    $formInputAttr = config('myconfig.template.form_element.input');
    $formSelect2Attr = config('myconfig.template.form_element.select2_feeship');
    $formSelect2GetChildAttr = array_merge_recursive(
                                    config('myconfig.template.form_element.select2_feeship'),
                                    config('myconfig.template.form_element.get_child'));
    $formSelect2GetChildAttr = MyFunction::array_fill_muti_values($formSelect2GetChildAttr);
    $formSelect2GetDataAttr = array_merge_recursive(
                                    config('myconfig.template.form_element.select2_feeship'),
                                    config('myconfig.template.form_element.get_data'));
    $formSelect2GetDataAttr = MyFunction::array_fill_muti_values($formSelect2GetDataAttr);
    $linkGetListDistrict = route('district.getListByParentID',['parentID' => 'value_new']);
    $linkGetListWard = route('ward.getListByParentID',['parentID' => 'value_new']);

    $linkGetFeeShip = route('cart.feeAjax');
    
    $formInputWidth['widthInput'] = 'col-12';
    

    $elements = [
        [
            'label' => Form::label('gender1', 'Anh',$formLabelAttr),
            'element' => Form::radio('gender','Nam',(!isset($user->gender) || ($user->gender==1) || ($user->gender != 2)) ? true: false),
            'type' =>'inline-text-right',
            'widthElement' => 'col-md-6 col-5',
            'styleFormGroup' => 'mb-1',
        ],[
            'label' => Form::label('gender2', ' Chị',$formLabelAttr),
            'element' => Form::radio('gender','Nữ',(isset($user->gender) && ($user->gender==1)) ? true: false),
            'type' =>'inline-text-right',
            'widthElement' => 'col-md-6 col-5',
            'styleFormGroup' => 'mb-1',
        ],[
            'label' => 'Họ tên',
            'element' => Form::text('fullname',null,array_merge(['class'=>'input-prescrip form-control','placeholder'=>'Nhập họ tên'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-lg-6 col-md-12 mb1024-5',
            'styleFormGroup' => 'has-border',
            'start'=>'*',
        ],[
            'label' => 'Số điện thoại',
            'element' => Form::text('phone', null,array_merge(['class'=>'input-prescrip form-control','placeholder'=>'Nhập số điện thoại'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-lg-6 col-md-12',
            'styleFormGroup' => 'has-border',
            'start'=>'*',
        ],
        [
            'label' => 'Email',
            'element' => Form::text('email', null,array_merge(['class'=>'input-prescrip','placeholder'=>'Nhập email'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-md-12',
            'styleFormGroup' => 'has-border',
        ]
    ];
    
    $formInputIgnoreAttr    = array_merge_recursive(
                                    config('myconfig.template.form_element.input'),
                                    ['class' => '']
                                    );
    $formInputIgnoreAttr = MyFunction::array_fill_muti_values($formInputIgnoreAttr);
    $formSelect2GetChildIgnoreAttr    = array_merge_recursive(
                                        $formSelect2GetChildAttr,
                                    ['class' => '']
                                    );
    $formSelect2GetChildIgnoreAttr = MyFunction::array_fill_muti_values($formSelect2GetChildIgnoreAttr);
    $inputHiddenTask    = Form::hidden('task', 'save_data');
    $formInputWidth['widthInput'] = 'wp-input';
    $elementLocals = [
        [
            'label'   => '',
            'element' => Form::select('province_id',[null=>"-- Chọn {$label['province_id']} --"] + $itemsProvince, $user->province_id??null, array_merge($formSelect2GetChildIgnoreAttr,['id' =>'province_id','style' =>'width:100%','data-href'=>$linkGetListDistrict,'data-href_fee'=>$linkGetFeeShip,'data-target' => '#district_id'])),
            'type' =>'select',
            'widthElement' => 'col-lg-6 col-md-12 mb1024-5'
        ],[
            'label'   => '',
            'element' => Form::select('district_id',[null=>"-- Chọn {$label['district_id']} --"], $details['district_id']??null, array_merge($formSelect2GetChildIgnoreAttr,['id' =>'district_id','data-href'=>$linkGetListWard,'data-href_fee'=>$linkGetFeeShip,'data-target' => '#ward_id','style' =>'width:100%'])),
            'type' =>'select',
            'widthElement' => 'col-lg-6 col-md-12 mb1024-5'
        ],[
            'label'   => '',
            'element' => Form::select('ward_id',[null=>"-- Chọn {$label['ward_id']} --"],  $details['ward_id']??null, array_merge($formSelect2Attr,['id' =>'ward_id','data-href_fee'=>$linkGetFeeShip,'style' =>'width:100%'])),
            'type' =>'select',
            'widthElement' => 'col-md-12 my-1'
        ],[
            'label' => '',
            'element' => Form::text('address', $details['address']??null,array_merge(['class'=>'input-prescrip form-control','placeholder'=>'Nhập địa chỉ'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-md-12',
            'styleFormGroup' => 'has-border'
        ],
    ];
@endphp
{{ Form::open([
    'method'         => 'POST',
    'url'            => route('OrderSuccess'),
    'accept-charset' => 'UTF-8',
    'class'          => 'form-complete-order',
    'id'             => ''])  }}
    <div class="section" id="customer-info-wp">
        <div class="section-head">
            <h1 class="section-title">Thông tin khách hàng</h1>
        </div>
        <div class="section-detail container-fluid">
            <div class="row">
                 {{ csrf_field() }}
                 {!! FormTemplate::show($elements,$formInputWidth)  !!}
                 <div class="col-md-12"><label for="">Địa chỉ<span class="text-danger"> *</span></label></div>
                 {!! FormTemplate::show($elementLocals,$formInputWidth)  !!}
                 <div class="col-md-12"><label for="">Ghi chú</label></div>
                 <div class="col-md-12"><textarea name="note" class="input-prescrip"></textarea></div>
            </div>
        </div>
    </div>
    <div class="section checkout-list-product" id="order-review-wp">
        @include('client.cart.child_checkout.list_product_cart')
    </div>
{{ Form::close() }}