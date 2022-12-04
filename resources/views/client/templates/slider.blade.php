@php
use App\Slider;
$_SESSION['slider']=Slider::orderBy('location')->where('status','Công khai')->get();
@endphp
<div class="section-detail">
    @foreach ($_SESSION['slider'] as $slider)
    <div class="item">
        <img src="{{asset($slider->image)}}" alt="" class="img-fluid">
    </div>
    @endforeach
</div>