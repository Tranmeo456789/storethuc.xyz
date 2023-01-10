@php
use App\Model\SliderModel;

$items=(new SliderModel)->listItems(null, ['task'  => 'frontend-list-items']);

@endphp
<div class="section-detail">
    @foreach ($items as $val)
    <div class="item">
        <img src="{{asset($val['image'])}}" alt="" class="img-fluid">
    </div>
    @endforeach
</div>