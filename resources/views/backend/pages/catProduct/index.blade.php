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
                @include("$moduleName.pages.$controllerName.list")
            </div>

        </div>
    </div>
</section>
@endsection