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
                    <main class="py-4">
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
                <div id="fb-root"></div>
            </div>
            @include("client.block.script")
    </body>
</html>