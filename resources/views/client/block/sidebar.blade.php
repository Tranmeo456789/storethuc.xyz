@php
use App\Product_cat;
use App\Product;
$_SESSION['cat_product']=Product_cat::all();
$_SESSION['product_sellign']=Product::inRandomOrder()->limit(8)->get();
@endphp
<div class="section" id="category-product-wp">
    <div class="section-head">
        <h3 class="section-title">Danh mục sản phẩm</h3>
    </div>
    <div class="secion-detail">
        <ul class="list-item">
            @foreach ($_SESSION['cat_product'] as $item2)
            @if ($item2['parent_id']==0)
            <li>
                <a href="{{route('cat0.product',$item2->slug)}}" title="" name='cat0_product' value="{{$item2['id']}}">{{$item2['title']}}</a>
                <!-- <ul class="sub-menu">
                                    @foreach ($_SESSION['cat_product_child'] as $item3)
                                        @if ($item3['parent_id']==$item2['id'])
                                        <li>
                                            <a href="{{route('cat1.product',$item3->slug)}}" title="">{{$item3['title']}}</a>
                                        </li> 
                                        @endif
                                    @endforeach                                   
                                </ul> -->
            </li>
            @endif
            @endforeach
        </ul>
    </div>
</div>
<div class="section" id="selling-wp">
    <div class="section-head">
        <h3 class="section-title">Sản phẩm bán chạy</h3>
    </div>
    <div class="section-detail">
        <ul class="list-item">
            @foreach ($_SESSION['product_sellign'] as $item1)
            <li class="clearfix">
                <a href="{{route('cat1.product',$item1->slug)}}" title="" class="thumb fl-left">
                    <img src="{{asset($item1['thumbnail'])}}" alt="" style="padding: 4px;">
                </a>
                <div class="info fl-right">
                    <a href="{{route('cat1.product',$item1->slug)}}" title="" class="product-name">{{$item1['name']}}</a>
                    <div class="price">
                        <span class="new">{{number_format($item1['price_current'], 0, "" ,"." )}}đ / {{$item1['unit']}}</span>
                        <!-- @if ($item1['price_old'])
                                            <span class="old">{{number_format($item1['price_old'], 0, "" ,"." )}}đ</span>
                                        @endif                                                                        -->
                    </div>
                    <a href="{{url('thanh-toan')}}" title="" class="buy-now">Mua ngay</a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="section" id="banner-wp">
    <div class="section-detail">
        <a href="" title="" class="thumb">
            <img src="{{asset('images/banner_doc3.png')}}" alt="">
        </a>
        <a href="" title="" class="thumb">
            <img src="{{asset('images/banner.png')}}" alt="">
        </a>
    </div>
</div>