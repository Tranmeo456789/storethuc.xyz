<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include("client.block.head")
</head>

<body>
    <div id="app">
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top">
                        @include("client.block.menu_head_top")
                    </div>
                    <div id="head-body">
                        @include("client.block.head_body")
                    </div>
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
            <div id="btn-zalo-me"><a href="https://zalo.me/0983195167"><img src="{{asset('images/zalo.png')}}" alt="" /></a></div>
            <div class="hotline-phone-ring-wrap">
                <div class="hotline-phone-ring">
                    <div class="hotline-phone-ring-circle"></div>
                    <div class="hotline-phone-ring-circle-fill"></div>
                    <div class="hotline-phone-ring-img-circle">
                        <a href="tel:0983195167" class="pps-btn-img">
                            <img src="{{asset('images/icon-call-nh.png')}}" alt="Gọi điện thoại" width="50">
                        </a>
                    </div>
                </div>
            </div>
            <!-- Messenger Plugin chat Code -->
            <div id="fb-root"></div>
            <!-- Your Plugin chat code -->
            <div id="fb-customer-chat" class="fb-customerchat"></div>
        </div>
    </div>
        @include("client.block.script")
</body>

</html>