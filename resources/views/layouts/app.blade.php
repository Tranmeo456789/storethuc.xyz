<!doctype html>
<html lang="vi">
<head>
    @include("client.block.head")
</head>
@php

    use App\Model\SettingModel;

    $params['id']=1;
    $infoSetting=(new SettingModel)->getItem($params, ['task' => 'frontend-get-item']);
    $colorHeaderFooter=$infoSetting['color_bg_header'];
    $colorBody=$infoSetting['color_bg_body'];
    $phoneAdmin=$infoSetting['phone'];
    $addressAdmin=$infoSetting['address'];

@endphp
<style>
    :root {
        --bg-header-color: {{$colorHeaderFooter}};
        --bg-body-color: {{$colorBody}};
    }
</style>
<body>
    <div id="app">
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div class="head_topon">
                        <div class="wp-inner">
                            <div class="d-flex justify-content-center">
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex align-items-center"><span class="circle-ripple"></span></div>
                                    <p lang="en">@lang('Kết nối mua sắm online')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="head-top" class="show-over1024">
                        @include("client.block.menu_head_top")
                    </div>
                    <div id="head-body" class="show-over1024">
                        @include("client.block.head_body")
                    </div>
                    <div id="head-body-resposive" class="show-below1024">
                        @include("client.block.box_responsive.head_body_responsive")
                    </div>
                    <div id="menu-responsive">
                        @include("client.block.box_responsive.menu_responsive")
                    </div>
                    <main class="">
                        @yield('content')
                    </main>
                    <div id="footer-wp">
                        @include("client.block.footer")
                    </div>
                </div>
                <div id="menu-respon">
                    @include("client.block.box_responsive.menu_responsive")
                </div>
                <div id="btn-top"><img src="{{asset('images/icon-to-top.png')}}" alt="" /></div>
                <div id="btn-zalo-me"><a href="https://zalo.me/{{$phoneAdmin}}"><img src="{{asset('images/zalo-2.png')}}" alt="" /></a></div>
                <div class="hotline-phone-ring-wrap">
                    <div class="hotline-phone-ring">
                        <div class="hotline-phone-ring-circle"></div>
                        <div class="hotline-phone-ring-circle-fill"></div>
                        <div class="hotline-phone-ring-img-circle">
                            <a href="tel:{{$phoneAdmin}}" class="pps-btn-img">
                                <img src="{{asset('images/icon-call-nh.png')}}" alt="Gọi điện thoại" width="50">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Messenger Plugin chat Code -->
                <div id="fb-root"></div>
                <!-- Your Plugin chat code -->
                <div id="fb-customer-chat" class="fb-customerchat"></div>
                <div id="fixscreen-respon"></div>
                <div class="black-screen"></div>
            </div>
        </div>
        @include("client.block.script")
</body>

</html>