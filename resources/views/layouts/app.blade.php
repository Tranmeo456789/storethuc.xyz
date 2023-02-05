<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include("client.block.head")
</head>

@php

    use App\Model\SettingModel;

    $params['id']=1;
    $infoSetting=(new SettingModel)->getItem($params, ['task' => 'frontend-get-item']);
    $colorHeaderFooter=$infoSetting['color_bg_header'];

@endphp

<style>
    :root {
        --bg-header-color: {{$colorHeaderFooter}};
    }

    #head-top {
        background: var(--bg-header-color);
    }
    #head-body {
        background: var(--bg-header-color);
    }
    #foot-bot {
        background: var(--bg-header-color);
    }
    #category-product-wp .section-title,
    #selling-wp .section-title,
    #filter-product-wp .section-title {
        background: var(--bg-header-color);
        color: #fff;
    }
    #feature-product-wp .section-title, #list-product-wp .section-title {
        color: rgb(255, 255, 255);
        background-color: var(--bg-header-color);
    }
    .border-bottom-title {
        display: block;
        width: 80%;
        border-top: 2px solid var(--bg-header-color);
    }
</style>

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
<!-- <script type='text/javascript'>
    //<![CDATA[
    var pictureSrc = "https://1.bp.blogspot.com/-CXx9jt2JMRk/Vq-Lh5fm88I/AAAAAAAASwo/XivooDn_oSY/s1600/hoamai.png"; //Link ảnh hoa muốn hiển thị trên web
    var pictureWidth = 20; //Chiều rộng của hoa mai or đào
    var pictureHeight = 20; //Chiều cao của hoa mai or đào
    var numFlakes = 14; //Số bông hoa xuất hiện cùng một lúc trên trang web
    var downSpeed = 0.005; //Tốc độ rơi của hoa
    var lrFlakes = 10; //Tốc độ các bông hoa giao động từ bên trai sang bên phải và ngược lại


    if (typeof(numFlakes) != 'number' || Math.round(numFlakes) != numFlakes || numFlakes < 1) {
        numFlakes = 10;
    }

    //draw the snowflakes
    for (var x = 0; x < numFlakes; x++) {
        if (document.layers) { //releave NS4 bug
            document.write('<layer id="snFlkDiv' + x + '"><imgsrc="' + pictureSrc + '" height="' + pictureHeight + '"width="' + pictureWidth + '" alt="*" border="0"></layer>');
        } else {
            document.write('<div style="position:absolute; z-index:9999;"id="snFlkDiv' + x + '"><img src="' + pictureSrc + '"height="' + pictureHeight + '" width="' + pictureWidth + '" alt="*"border="0"></div>');
        }
    }

    //calculate initial positions (in portions of browser window size)
    var xcoords = new Array(),
        ycoords = new Array(),
        snFlkTemp;
    for (var x = 0; x < numFlakes; x++) {
        xcoords[x] = (x + 1) / (numFlakes + 1);
        do {
            snFlkTemp = Math.round((numFlakes - 1) * Math.random());
        } while (typeof(ycoords[snFlkTemp]) == 'number');
        ycoords[snFlkTemp] = x / numFlakes;
    }

    //now animate
    function flakeFall() {
        if (!getRefToDivNest('snFlkDiv0')) {
            return;
        }
        var scrWidth = 0,
            scrHeight = 0,
            scrollHeight = 0,
            scrollWidth = 0;
        //find screen settings for all variations. doing this every time allows for resizing and scrolling
        if (typeof(window.innerWidth) == 'number') {
            scrWidth = window.innerWidth;
            scrHeight = window.innerHeight;
        } else {
            if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
                scrWidth = document.documentElement.clientWidth;
                scrHeight = document.documentElement.clientHeight;
            } else {
                if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
                    scrWidth = document.body.clientWidth;
                    scrHeight = document.body.clientHeight;
                }
            }
        }
        if (typeof(window.pageYOffset) == 'number') {
            scrollHeight = pageYOffset;
            scrollWidth = pageXOffset;
        } else {
            if (document.body && (document.body.scrollLeft || document.body.scrollTop)) {
                scrollHeight = document.body.scrollTop;
                scrollWidth = document.body.scrollLeft;
            } else {
                if (document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop)) {
                    scrollHeight = document.documentElement.scrollTop;
                    scrollWidth = document.documentElement.scrollLeft;
                }
            }
        }
        //move the snowflakes to their new position
        for (var x = 0; x < numFlakes; x++) {
            if (ycoords[x] * scrHeight > scrHeight - pictureHeight) {
                ycoords[x] = 0;
            }
            var divRef = getRefToDivNest('snFlkDiv' + x);
            if (!divRef) {
                return;
            }
            if (divRef.style) {
                divRef = divRef.style;
            }
            var oPix = document.childNodes ? 'px' : 0;
            divRef.top = (Math.round(ycoords[x] * scrHeight) + scrollHeight) + oPix;
            divRef.left = (Math.round(((xcoords[x] * scrWidth) - (pictureWidth / 2)) + ((scrWidth / ((numFlakes + 1) * 4)) * (Math.sin(lrFlakes * ycoords[x]) - Math.sin(3 * lrFlakes * ycoords[x])))) + scrollWidth) + oPix;
            ycoords[x] += downSpeed;
        }
    }

    //DHTML handlers
    function getRefToDivNest(divName) {
        if (document.layers) {
            return document.layers[divName];
        } //NS4
        if (document[divName]) {
            return document[divName];
        } //NS4 also
        if (document.getElementById) {
            return document.getElementById(divName);
        } //DOM (IE5+, NS6+, Mozilla0.9+, Opera)
        if (document.all) {
            return document.all[divName];
        } //Proprietary DOM - IE4
        return false;
    }

    window.setInterval('flakeFall();', 100);
    //]]>
</script> -->
</html>