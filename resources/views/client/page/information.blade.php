@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="secion" id="breadcrumb-wp">
                    <div class="secion-detail">
                        <ul class="list-item clearfix">
                            <li>
                                <a href="{{url('/')}}" title="">Trang chủ</a>
                            </li>
                            <li>
                                <a href="{{route('pages','tin-tuc')}}" title="">Tin tức</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h5 style="text-transform: uppercase">Mới nhất</h5>
                <span class=" border border-2 border-muted" style="display: block"></span>
                <div>
                    <ul class="list-post-new">
                        @foreach ($posts as $item)
                            @if ($item['cat_id']==10)
                                <li class="pt-3  pb-3">
                                    <div class="clearfix">
                                        <div class="float-left" style="max-width: 28%;"><a href="{{route('post.detail', $item->slug)}}" class="p-r-4"><img  src="{{asset($item->thumbnail)}}" alt=""></a></div>
                                    
                                        <h5 class="float-right title-post" style="max-width: 70%;"><a href="{{route('post.detail', $item->slug)}}">{{$item->title}}</a></h5>
                                    </div>       
                                </li>
                            @endif                           
                       @endforeach                        
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <h5 style="text-transform: uppercase">khuyến mãi</h5>
                <span class=" border border-2 border-muted" style="display: block"></span>
                <div>
                    <ul class="list-post-new">
                        @foreach ($posts as $item)
                            @if ($item['cat_id']==4)
                                <li class="pt-3 pb-3">
                                    <div>
                                        <div class="" style=""><a href="{{route('post.detail', $item->slug)}}" class="p-r-4"><img  src="{{asset($item->thumbnail)}}" alt=""></a></div>
                                    
                                        <h5 class="title-post mt-3"><a href="{{route('post.detail', $item->slug)}}">{{$item->title}}</a></h5>
                                    </div>       
                                </li>
                            @endif                           
                       @endforeach                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
