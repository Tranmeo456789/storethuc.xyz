@if($image_products)
<div class="thumb-wp fl-left">
    @if ($image_products[0]['image'])
    <figure id="main-thumb" class="zoom" style="background-image:url({{asset($image_products[0]['image'])}})" onmousemove="zoom(event)" ontouchmove="zoom(event)">
        <img src="{{asset($image_products[0]['image'])}}">
    </figure>
    @endif
    <div id="list-thumb">
        @foreach ($image_products as $image_product)
        <div>
            @if ($image_product['image'])
            <div class="image-click" href="" data-image="" data-zoom-image="">
                <img style="padding: 2px" src="{{asset($image_product['image'])}}" />
            </div>
            @endif
            @if ($image_product->name_color)
            <div class="text-center small" style="min-height: 100px">{{$image_product->name_color}}</div>
            @endif
        </div>
        @endforeach
    </div>
</div>
    @if ($image_products[0]['image'])
    <div class="thumb-respon-wp fl-left">
        <img src="{{asset($image_products[0]['image'])}}" alt="">
    </div>
@endif
@endif