@php
    use App\Helpers\Template;
    use App\Helpers\MyFunction;
    use App\Helpers\Form as FormTemplate;
    $date             = isset($item['date'])?MyFunction::formatDateFrontend($item['date']):'';
    $formDateMaskAttr = config('myconfig.template.form_element.input_datemask');
    $formInputWidth['widthInput']  =  'col-12';
    $elements =[
            [
            'label'   => '',
            'element' => Form::text('date_start', $date, array_merge($formDateMaskAttr,['placeholder'=>'Từ ngày'])),
            'widthElement' => 'col-4'
            ],
            [
            'label'   => '',
            'element' => Form::text('date_end', $date, array_merge($formDateMaskAttr,['placeholder'=>'Đến ngày'])),
            'widthElement' => 'col-4'
            ],
            
        ];
@endphp
<div class="card card-outline card-primary mb800-0">
    @include("$moduleName.blocks.x_title", ['title' => 'DOANH THU BÁN HÀNG'])
    <div class="card-body p-3">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    {!! FormTemplate::show($elements,$formInputWidth) !!}
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="text-center col-4"><button class="btn btn-primary filter-revenue-in-time" data-href="{{route('dashboard.filterInDay')}}">Lọc kết quả</button></div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <h4 class="text-gray">Tổng giá trị: <span class="total-revenue text-info">{{MyFunction::formatNumber($total_revenue) . ' đ' ?? '0'}}</span></h4>
            </div>
            <!-- <div class="col-12 text-center">
                <img src="{{asset('shop/images/productnull.PNG')}}" alt="">
                <h6 class="text-center">Chưa có dữ liệu</h6>
            </div> -->
        </div>
    </div>
</div>