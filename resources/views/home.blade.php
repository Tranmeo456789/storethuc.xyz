@extends('layouts.app')

@section('content')

<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
            @include("client.templates.slider")
            </div>
            <div class="section mb-3" id="support-wp">
                @include("client.templates.support")
            </div>
            <div class="section mb-3" id="feature-product-wp">
            @include("client.templates.list_product_featured")
            </div>
            <div class="section mb-3" id="list-product-wp">
            @include("client.templates.list_product_of_all_cat")
            </div>          
        </div>
        <div class="sidebar fl-left">
        @include("client.block.sidebar")
        </div>
    </div>
</div>
@endsection
