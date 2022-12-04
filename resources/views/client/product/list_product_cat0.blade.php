@extends('layouts.app')

@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
            @include("client.templates.list_product_of_one_cat")
            </div>
        </div>
        <div class="sidebar fl-left">
        @include("client.block.sidebar")
        </div>
    </div>
</div>
@endsection