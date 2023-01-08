@php
use App\Model\PageModel;

$params['slug']=$slugpage;
$page=(new PageModel)->getItem($params,['task'=>'get-item-in-slug']);

@endphp

@extends('layouts.app')

@section('content')
<div class="wp-inner">
    {!!$page->content!!}
</div>

@endsection
