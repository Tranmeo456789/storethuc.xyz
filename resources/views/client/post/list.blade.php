@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="secion pt-2" id="breadcrumb-wp">
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
            @php
                use App\Model\PostModel;

                $temp=0;
            @endphp
            @foreach($catPost as $item)
                @php
                    $temp++;
                @endphp
                @if($temp%2 != 0)
                    <div class="col-md-8">
                        <h5 style="text-transform: uppercase">{{$item['name']}}</h5>
                        <span class=" border border-2 border-muted" style="display: block"></span>
                        <div>
                            <ul class="list-post-new">  
                            @php
                                $catId=$item['id'];
                                $post=(new PostModel)->listItems(['cat_id'=>$catId,'limit'=>8],['task'=>'get-list-items-of-one-cat']);
                            @endphp   
                            @foreach($post as $val)                 
                                <li class="pt-3  pb-3">
                                    <div class="clearfix">
                                        <div class="float-left" style="max-width: 28%;"><a href="{{route('post.detail', $val->slug)}}" class="p-r-4"><img  src="{{asset($val->thumbnail)}}" alt=""></a></div>
                                        <h5 class="float-right title-post" style="max-width: 70%;"><a href="{{route('post.detail', $val->slug)}}">{{$val->name}}</a></h5>
                                    </div>       
                                </li>   
                            @endforeach                                             
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="col-md-4">
                    <h5 style="text-transform: uppercase">{{$item['name']}}</h5>
                    <span class=" border border-2 border-muted" style="display: block"></span>
                        <div>
                            <ul class="list-post-new">
                            @php
                                $catId=$item['id'];
                                $post=(new PostModel)->listItems(['cat_id'=>$catId,'limit'=>8],['task'=>'get-list-items-of-one-cat']);
                            @endphp   
                            @foreach($post as $val)
                                <li class="pt-3 pb-3">
                                    <div>
                                        <div class=""><a href="{{route('post.detail', $val->slug)}}" class="p-r-4"><img  src="{{asset($val->thumbnail)}}" alt=""></a></div>
                                        <h5 class="title-post mt-3"><a href="{{route('post.detail', $val->slug)}}">{{$val->name}}</a></h5>
                                    </div>       
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                @endif         
            @endforeach
        </div>
    </div>
@endsection
