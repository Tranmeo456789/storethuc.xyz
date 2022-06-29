@extends('layouts.app')
@section('content')
    <div class="container">
       <h2 class='mb-3'>{{$post->title}}</h2>
       <div class="text-muted mb-3">

           <span class="mr-3"><i class="fa fa-user" aria-hidden="true"></i> {{$user->name}}</span>
           <span class=""><i class="fa fa-clock-o" aria-hidden="true"></i>  {{$time_created}}</span>
       </div>
       <div>{!!$post->content!!}</div>
    </div>
@endsection