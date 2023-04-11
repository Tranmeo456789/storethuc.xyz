@php
    use App\Helpers\Form as FormTemplate;

    $formInputWidth['widthInput']  =  'col-12 p-0';

    $inputHiddenTask    = Form::hidden('task', 'save_data');

    $elements = [
        [
            'label'   => '',
            'element' => Form::tel('phone', null,['class'=>'form-control','placeholder'=>'Nhập số điện thoại mua hàng','autocomplete'=>'off','id'=>'phone']),
            'type' => 'input-group-addon-image-before',
            'image' => asset('images/phone_mini.png'),
            'widthElement' => 'col-12 p-0',
            'styleFormGroup' => 'has-border',
        ]
    ];
@endphp
@extends('layouts.app')
@section('content')
<div class="container my-4">
    <div class="wp-search-phone-order d-flex justify-content-center">
        <div class="d1 step1">
            <span>Tra cứu thông tin đơn hàng</span>
            {{ Form::open([
                'method'         => 'POST',
                'url'            => route('order.search.phone_order'),
                'accept-charset' => 'UTF-8',
                'class'          => 'form-search-phone-order',
                'id'             => ''])  }}
    
            {!! FormTemplate::show($elements,$formInputWidth)  !!}
            <div class="text-center col-12">
                {{$inputHiddenTask }}
                <button type="submit" class="btn mt-4" name="btnSearchPhoneOrder" value="1">Tiếp tục</button>
            </div>
{{ Form::close() }}
        </div>
    </div>
</div>
@endsection