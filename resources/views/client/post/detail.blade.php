@extends('layouts.app')
@section('content')
    <div class="container">
       <h2 class='mb-3 pt-3'>{{$item['name']}}</h2>
       <div class="text-muted mb-3">
           <span class="mr-3"><i class="fa fa-user" aria-hidden="true"></i> {{$item['user_id']}}</span>
           <span class=""><i class="fa fa-clock-o" aria-hidden="true"></i>  {{$item['created_at']}}</span>
       </div>
       <div>{!!$item->content!!}</div>
    </div>
@endsection