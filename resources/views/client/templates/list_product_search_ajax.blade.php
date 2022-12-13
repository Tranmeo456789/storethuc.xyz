@foreach($result as $item)

<li class="product-suggest">
    <a href="">
        <div class="item-img">
            <div class="wp-img-search">
                <img src="asset($item->thumbnail)">
            </div>
        </div>
        <div class="item-info">
            <p class="product-name truncate2">'.$item->name.'</p>
            <strong class="price-new">number_format($item->price, 0, "" ,"." )đ/$item->unitProduct->name</strong>
        </div>
    </a>
</li>
@endforeach
