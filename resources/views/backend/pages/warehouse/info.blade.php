
@extends('layouts.backend')

@section('title',$pageTitle)
@section('content')

<section class="content">
    @include("$moduleName.blocks.notify")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'Danh sách'])
                    <div class="card-body p-0">
                        @include("$moduleName.pages.$controllerName.list_info")
                    </div>
                    <div class="card-footer my-card-pagination clearfix">
                         @include("$moduleName.blocks.pagination",['paginator'=>$itemsProduct])
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection