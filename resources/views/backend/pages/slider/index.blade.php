@php
use App\Helpers\Template;
@endphp
@extends('layouts.backend')

@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => true])
<section class="content">
    @include("$moduleName.blocks.notify")
    <div class="">
        <div class="card card-outline card-primary">
            @include("$moduleName.blocks.x_title", ['title' => 'Danh sách'])
            <div class="card-body p-0">
                {!! Template::showTabFilter($controllerName, $itemStatusCount, $params['filter']['status_slider'], $params,'status_slider'); !!}

                @include("$moduleName.pages.$controllerName.list")
            </div>
            <div class="card-footer my-card-pagination clearfix">
                @include("$moduleName.blocks.pagination",['paginator'=>$items])
            </div>
        </div>
    </div>
</section>
@endsection