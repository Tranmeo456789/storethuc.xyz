
$(document).ready(function () {
    //jquery validate
    function isPhoneNumberVN(value) {
        var flag = false;
        var phone = value.trim(); // ID của trường Số điện thoại
        phone = phone.replace('(+84)', '0');
        phone = phone.replace('+84', '0');
        phone = phone.replace('0084', '0');
        phone = phone.replace(/ /g, '');
        if (phone != '') {
            var firstNumber = phone.substring(0, 2);
            if ((firstNumber == '09' || firstNumber == '08' || firstNumber == '07' || firstNumber == '05' || firstNumber == '03') && phone.length == 10) {
                if (phone.match(/^\d{10}/)) {
                    flag = true;
                }
            } else if (firstNumber == '02' && phone.length == 11) {
                if (phone.match(/^\d{11}/)) {
                    flag = true;
                }
            }
        }
        return flag;
    }
    function isEmail(value) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(value);
    }
    $.validator.methods.checkEmail = function (value, element, param) {
        return (value.trim() == '') || (isEmail(value.trim()));
    };
    $.validator.methods.checkPhone = function (value, element, param) {
        return isPhoneNumberVN(value);
    };
    //  SLIDER
    var slider = $('#slider-wp .section-detail');
    slider.owlCarousel({
        autoPlay: 4500,
        navigation: false,
        navigationText: false,
        paginationNumbers: false,
        pagination: true,
        items: 1, //10 items above 1000px browser width
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });
    $(".select2").select2().change(function() {
        $(this).valid();
      });
    //  ZOOM PRODUCT DETAIL
    $("#zoom").elevateZoom({ gallery: 'list-thumb', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif' });

    //  LIST THUMB
    var list_thumb = $('#list-thumb');
    list_thumb.owlCarousel({
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 5, //10 items above 1000px browser width
        itemsDesktop: [1000, 5], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 5], // betweem 900px and 601px
        itemsTablet: [768, 5], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

    //  FEATURE PRODUCT
    var feature_product = $('#feature-product-wp .list-item');
    feature_product.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SAME CATEGORY
    var same_category = $('#same-category-wp .list-item');
    same_category.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SCROLL TOP
    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            $('#btn-top').stop().fadeIn(150);
        } else {
            $('#btn-top').stop().fadeOut(150);
        }
    });
    $('#btn-top').click(function () {
        $('body,html').stop().animate({ scrollTop: 0 }, 800);
    });

    // CHOOSE NUMBER ORDER
    var value = Number(parseInt($('#num-order').attr('value')));
    
    $('#plus').on('click', function (event) {
        var qtyMax  = $(this).prev('#num-order').attr("max");
        if (value < qtyMax) {
            value++;
            $('#num-order').attr('value', value);
        }
        //update_href(value);
    });
    $('#minus').on('click', function (event) {
        if (value > 1) {
            value--;
            $('#num-order').attr('value', value);
        }
        // update_href(value);
    });

    //  MAIN MENU
    $('#category-product-wp .list-item > li').find('.sub-menu').after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');

    //  TAB
    tab();

    //  EVEN MENU RESPON
    $('html').on('click', function (event) {
        var target = $(event.target);
        var site = $('#site');

        if (target.is('#btn-respon i')) {
            if (!site.hasClass('show-respon-menu')) {
                site.addClass('show-respon-menu');
            } else {
                site.removeClass('show-respon-menu');
            }
        } else {
            $('#container').click(function () {
                if (site.hasClass('show-respon-menu')) {
                    site.removeClass('show-respon-menu');
                    return false;
                }
            });
        }
    });
    //  MENU RESPON
    $('#main-menu-respon li .sub-menu').after('<span class="fa fa-angle-right arrow"></span>');
    $('#main-menu-respon li .arrow').click(function () {
        if ($(this).parent('li').hasClass('open')) {
            $(this).parent('li').removeClass('open');
        } else {

            //            $('.sub-menu').slideUp();
            //            $('#main-menu-respon li').removeClass('open');
            $(this).parent('li').addClass('open');
            //            $(this).parent('li').find('.sub-menu').slideDown();
        }
    });
    $(".form-search-phone-order").validate({
        ignore: ".ignore",
        rules: {
            phone: {
                required: true,
                checkPhone: true,
            }
        },
        messages: {
            phone: {
                required: "Nhập số điện thoại",
                checkPhone: "Số điện thoại không đúng định dạng"
            }
        },
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");
            element.closest(".input-group").addClass('has-error');
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.next("label"));
            } else {
                error.insertAfter(element.closest(".input-group"));
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
            $(element).closest(".input-group").removeClass('has-error');
        }
    });
    $(".form-complete-order").validate({
        ignore: ".ignore",
        rules: {
            fullname:{
                required: true,
            },
            phone: {
                required: true,
                checkPhone: true,
            },
            email: {
                checkEmail: true,
            },
            province_id:{
                required: true,
            },
            district_id:{
                required: true,
            },
            ward_id:{
                required: true,
            },
            address:{
                required: true,
            },    
        },
        messages: {
            fullname:{
                required: "Thông tin bắt buộc", 
            },
            phone: {
                required: "Thông tin bắt buộc", 
                checkPhone: "Số điện thoại không đúng định dạng",             
            },
            email: {
                checkEmail: "Email không đúng định dạng",             
            },
            province_id:{
                required:"Thông tin bắt buộc",
            },
            district_id:{
                required: "Thông tin bắt buộc",
            },
            ward_id:{
                required: "Thông tin bắt buộc",
            },
            address:{
                required: "Thông tin bắt buộc",
            },                             
        },
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");
            element.closest(".wp-input").addClass('has-error');                  
            error.insertAfter(element.closest(".wp-input"));          
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
            $(element).closest(".wp-input").removeClass('has-error');
        }
    });
    $('.add-cart').on('click', function (event) {
        event.preventDefault();
        var imgtodrag = $(this).parents('.wp-effect-cart').find("img").eq(0);
        var id = $(this).attr("data-id");
        var _token = $('input[name="_token"]').val();
        var url = $(this).attr("data-url");
        var widthScreen = window.innerWidth;
        if(widthScreen <= 1024){
            var cart = $('.wp-icon-cart-respon');
        }else{
            var cart = $('.wp-icon-cart');
        }
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                    top: imgtodrag.offset().top,
                    left: imgtodrag.offset().left
                })
                .css({
                    'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'overflow':'hidden',
                    'border-radius':'50%',
                    'z-index': '100'
                })
                .appendTo($('body'))
                .animate({
                    'top': cart.offset().top + 10,
                    'left': cart.offset().left + 15,
                    'width': 10,
                    'height': 10
                }, 1000, 'easeInOutExpo');

            setTimeout(function () {
                cart.effect("shake", {
                    times: 2
                }, 200);
            }, 1500);

            imgclone.animate({
                'width': 0,
                'height': 0
            }, function () {
                $(this).detach()
            });
        }
        setTimeout(addCartAjax, 1000);
        function addCartAjax(){
            $.ajax({
                url: url,
                method: "GET",
                dataType: 'html',
                data: {
                    id: id,
                    _token: _token
                },
                success: function(data) {
                    $(".wp-icon-cart").html(data);
                },
            });
        }
        
    });
    $(".select2").select2();
});
function tab() {
    var tab_menu = $('#tab-menu li');
    tab_menu.stop().click(function () {
        $('#tab-menu li').removeClass('show');
        $(this).addClass('show');
        var id = $(this).find('a').attr('href');
        $('.tabItem').hide();
        $(id).show();
        return false;
    });
    $('#tab-menu li:first-child').addClass('show');
    $('.tabItem:first-child').show();
}
$(document).on('click', "#btnmenu-resp", function () {
    $('#fixscreen-respon').css("display", "block");
    $('#menu-responsive').addClass("slider");
});
const menu_responsive = document.getElementById('menu-responsive');
const fixscreen_respon = document.getElementById('fixscreen-respon');
const closem = document.getElementById('closem');
closem.addEventListener('click', () => {
    $('#menu-responsive').removeClass("slider");
    $('#fixscreen-respon').css("display", "none");
});
fixscreen_respon.addEventListener('click', (e) => {
    if (!menu_responsive.contains(e.target)) {
        closem.click();
    }
});
//xoay arrow 180deg
$(document).on('click', ".icon-arrow", function () {
    $(this).parents('.parentsmenu').children('.submenu1res').toggleClass('display-vis');
    $(this).toggleClass('arrow-rotate');
});


$(document).on('submit', "#main-form", function (event) {
    event.preventDefault();
    url = $(this).attr("action");
    method = $(this).attr('method');
    data = new FormData($(this)[0]);
    $.ajax({
        type: method,
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.success == false) {
                if (response.error != null) {
                    for (control in response.errors) {
                        eleError = "<label id='" + control + "-error' class='error invalid-feedback' for='" + control + "' style='display:inline-block'>" + response.errors[control] + "</label>";
                        $('[name=' + control + ']').closest(".form-group").find("label[for='" + control + "']").remove();
                        $('[name=' + control + ']').closest(".input-group").addClass('has-error').after(eleError);
                        $('[name=' + control + ']').addClass("is-invalid").removeClass('is-valid');
                    }
                } else {
                    alert(response.message);
                }
            } else {
                alert(response.message);
                window.location.replace(response.redirect_url);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });
});
$(document).on('click', ".select-status-order", function (event) {
    var status = $(this).attr("data-status");
    var url = $(this).attr("data-href");
    var _token = $('input[name="_token"]').val();
    var phone = $(this).attr("data-phone");
    $.ajax({
        url: url,
        cache: false,
        method: "GET",
        dataType: 'html',
        data: {
            status: status,
            phone: phone,
            _token: _token
        },
        success: function(data) {
            //console.log(data);
            $('.table-order-frontend').html(data);
        },
    }); 
});
$(document).on('click', ".view-detail-order", function (event) {
    $('.wp-detail-order').css("display", "block");
    $('.black-screen').css("display", "block");
    //$('#container').addClass("fixed-hbd");
    var id = $(this).attr("data-id");
    var url = $(this).attr("data-href");
    var _token = $('input[name="_token"]').val();
    //alert(url);
    $.ajax({
        url: url,
        cache: false,
        method: "GET",
        dataType: 'html',
        data: {
            id: id,
            _token: _token,
        },
        success: function(data) {
            //console.log(data['test']['fullname']);
            $('.wp-detail-order').html(data);
        },
    }); 
});
$(document).on('click', ".btn-closenk", function (event) {
    $('.wp-detail-order').css("display", "none");
    $('.black-screen').css("display", "none");
    $('.titlek').removeClass("fixed-hbd");
   
});
//hieu ung hoa dao
    // var pictureSrc = "https://1.bp.blogspot.com/-CXx9jt2JMRk/Vq-Lh5fm88I/AAAAAAAASwo/XivooDn_oSY/s1600/hoamai.png"; //Link ảnh hoa muốn hiển thị trên web
    // var pictureWidth = 20; //Chiều rộng của hoa mai or đào
    // var pictureHeight = 20; //Chiều cao của hoa mai or đào
    // var numFlakes = 14; //Số bông hoa xuất hiện cùng một lúc trên trang web
    // var downSpeed = 0.005; //Tốc độ rơi của hoa
    // var lrFlakes = 10; //Tốc độ các bông hoa giao động từ bên trai sang bên phải và ngược lại

    // if (typeof(numFlakes) != 'number' || Math.round(numFlakes) != numFlakes || numFlakes < 1) {
    //     numFlakes = 10;
    // }
    // //draw the snowflakes
    // for (var x = 0; x < numFlakes; x++) {
    //     if (document.layers) { //releave NS4 bug
    //         document.write('<layer id="snFlkDiv' + x + '"><imgsrc="' + pictureSrc + '" height="' + pictureHeight + '"width="' + pictureWidth + '" alt="*" border="0"></layer>');
    //     } else {
    //         document.write('<div style="position:absolute; z-index:9999;"id="snFlkDiv' + x + '"><img src="' + pictureSrc + '"height="' + pictureHeight + '" width="' + pictureWidth + '" alt="*"border="0"></div>');
    //     }
    // }
    // //calculate initial positions (in portions of browser window size)
    // var xcoords = new Array(),
    //     ycoords = new Array(),
    //     snFlkTemp;
    // for (var x = 0; x < numFlakes; x++) {
    //     xcoords[x] = (x + 1) / (numFlakes + 1);
    //     do {
    //         snFlkTemp = Math.round((numFlakes - 1) * Math.random());
    //     } while (typeof(ycoords[snFlkTemp]) == 'number');
    //     ycoords[snFlkTemp] = x / numFlakes;
    // }

    // //now animate
    // function flakeFall() {
    //     if (!getRefToDivNest('snFlkDiv0')) {
    //         return;
    //     }
    //     var scrWidth = 0,
    //         scrHeight = 0,
    //         scrollHeight = 0,
    //         scrollWidth = 0;
    //     //find screen settings for all variations. doing this every time allows for resizing and scrolling
    //     if (typeof(window.innerWidth) == 'number') {
    //         scrWidth = window.innerWidth;
    //         scrHeight = window.innerHeight;
    //     } else {
    //         if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
    //             scrWidth = document.documentElement.clientWidth;
    //             scrHeight = document.documentElement.clientHeight;
    //         } else {
    //             if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
    //                 scrWidth = document.body.clientWidth;
    //                 scrHeight = document.body.clientHeight;
    //             }
    //         }
    //     }
    //     if (typeof(window.pageYOffset) == 'number') {
    //         scrollHeight = pageYOffset;
    //         scrollWidth = pageXOffset;
    //     } else {
    //         if (document.body && (document.body.scrollLeft || document.body.scrollTop)) {
    //             scrollHeight = document.body.scrollTop;
    //             scrollWidth = document.body.scrollLeft;
    //         } else {
    //             if (document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop)) {
    //                 scrollHeight = document.documentElement.scrollTop;
    //                 scrollWidth = document.documentElement.scrollLeft;
    //             }
    //         }
    //     }
    //     //move the snowflakes to their new position
    //     for (var x = 0; x < numFlakes; x++) {
    //         if (ycoords[x] * scrHeight > scrHeight - pictureHeight) {
    //             ycoords[x] = 0;
    //         }
    //         var divRef = getRefToDivNest('snFlkDiv' + x);
    //         if (!divRef) {
    //             return;
    //         }
    //         if (divRef.style) {
    //             divRef = divRef.style;
    //         }
    //         var oPix = document.childNodes ? 'px' : 0;
    //         divRef.top = (Math.round(ycoords[x] * scrHeight) + scrollHeight) + oPix;
    //         divRef.left = (Math.round(((xcoords[x] * scrWidth) - (pictureWidth / 2)) + ((scrWidth / ((numFlakes + 1) * 4)) * (Math.sin(lrFlakes * ycoords[x]) - Math.sin(3 * lrFlakes * ycoords[x])))) + scrollWidth) + oPix;
    //         ycoords[x] += downSpeed;
    //     }
    // }
    // //DHTML handlers
    // function getRefToDivNest(divName) {
    //     if (document.layers) {
    //         return document.layers[divName];
    //     } //NS4
    //     if (document[divName]) {
    //         return document[divName];
    //     } //NS4 also
    //     if (document.getElementById) {
    //         return document.getElementById(divName);
    //     } //DOM (IE5+, NS6+, Mozilla0.9+, Opera)
    //     if (document.all) {
    //         return document.all[divName];
    //     } //Proprietary DOM - IE4
    //     return false;
    // }
    // window.setInterval('flakeFall();', 100);
//ket thuc hieu ung hoa dao
// start message facebook
var chatbox = document.getElementById('fb-customer-chat');
chatbox.setAttribute("page_id", "111239241882176");
chatbox.setAttribute("attribution", "biz_inbox");
window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v15.0'
    });
  };
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://storethuc.xyz/public/js/chat-facebook.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  $(document).on('click', ".add-cart1", function (event){
    event.preventDefault();
    var id = $(this).attr("data-id");
    var _token = $('input[name="_token"]').val();
    var url = $(this).attr("data-url");
    var urlShowCart = $(this).attr("data-urlShowCart");
        $.ajax({
            url: url,
            method: "GET",
            data: {
                id: id,
                _token: _token
            },
            success: function(data) {
                swal({
                        title: "Thêm sản phẩm thành công!",
                        type: "success",
                        text: "Bạn có muốn đi đến giỏ hàng?",
                        showCancelButton: true,
                        confirmButtonClass: "btn-primary",
                        confirmButtonText: "Yes",
                        cancelButtonClass: "btn-warning",
                        cancelButtonText: "No",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        var id = $(this).attr("data-id");
                        if (isConfirm) {
                            window.location.href = urlShowCart;
                        } else {
                            window.location.reload();
                        }
                    });
            },
        });
    });
//update cart ajax
$(document).on('click', ".minus1", function (event){
    if (Number($(this).next('.num-order').val()) > 1) {
        var num_per_product = Number($(this).next('.num-order').val()) - 1;
        $(this).next('.num-order').val(num_per_product);
        var qty = $(this).next('.num-order').val();
        var id = $(this).next('.num-order').attr("data-id");
        var url = $(this).next('.num-order').attr("data-url");
        var rowId = $(this).next('.num-order').attr("data-rowId");
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: url,
            method: "POST",
            dataType: 'json',
            data: {
                qty: qty,
                id: id,
                rowId: rowId,
                _token: _token
            },
            success: function(data) {
                $(".sub-total" + id).text(data.sub_total);
                $(".num-cart").text(data.num_order);
                $("#total-cart").text(data.total_cart);
                $('#dropdown').html(data.list_cart);
            },
        });
    }

});
$(document).on('click', ".plus1", function (event){
    var qtyMax = $(this).prev('.num-order').attr("max");
    if (Number($(this).prev('.num-order').val()) < qtyMax) {
        var num_per_product = Number($(this).prev('.num-order').val()) + 1;
        $(this).prev('.num-order').val(num_per_product);
        var qty = $(this).prev('.num-order').val();
        var id = $(this).prev('.num-order').attr("data-id");
        var url = $(this).prev('.num-order').attr("data-url");
        var rowId = $(this).prev('.num-order').attr("data-rowId");
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: url,
            method: "POST",
            dataType: 'json',
            data: {
                qty: qty,
                id: id,
                qtyMax: qtyMax,
                rowId: rowId,
                _token: _token
            },
            success: function(data) {
                $(".sub-total" + id).text(data.sub_total);
                $(".num-cart").text(data.num_order);
                $("#total-cart").text(data.total_cart);
                $('#dropdown').html(data.list_cart);
            },
        });
    }
});
$(document).on('change', ".num-order", function (event){
    var qty = Number($(this).val());
    var qtyFrist = $(this).attr("data-qtyFrist");
    var qtyMax = $(this).attr("max");
    if(qty<1){
        qty=1;
    }else if(qty>qtyMax){
        qty=qtyMax;
    }else if(qty>=1 && qty<=qtyMax){
        qty=qty;
    }else{
        qty=qtyFrist;
    }
    $(this).val(qty);
    var id = $(this).attr("data-id");
    var url=$(this).attr("data-url");
    var rowId = $(this).attr("data-rowId");
    var _token = $('input[name="_token"]').val();
        
    $.ajax({
        url: url,
        method: "POST",
        dataType: 'json',
        data: {
            qty: qty,
            id: id,
            rowId: rowId,
            _token: _token
        },
        success: function(data) {
            $(".sub-total" + id).text(data.sub_total);
            $(".num-cart").text(data.num_order);
            $("#total-cart").text(data.total_cart);
             $('#dropdown').html(data.list_cart);
        },
    });
    
});
$(document).on('change', "select.get_child", function (event) {
    event.preventDefault();
    url = $(this).data('href');

    target = $(this).data('target');
    $selectValue = $(this).val();

    if (($selectValue == '') && (url != '') && (url.indexOf('value_new') !== -1)) {
        options = $(target).find('option')[0].outerHTML;
        $(target).html(options);
         $(target).trigger("change");
    } else {
        url = url.replace('value_new', $selectValue);
        let addtion = $(this).data('addtion');
        if (addtion !== undefined) {
            addtion = addtion.split('|');
            addtion.forEach(function (elem, index) {
                elemValue = $('#' + elem).val();
                if (elemValue != '') {
                    if (url.indexOf('?') === -1) {
                        url += "?filter_" + elem + "=" + elemValue;
                    } else {
                        url += "&filter_" + elem + "=" + elemValue;
                    }
                }
            });
        }
        $.get({
            url: url,
            cache: false,
            dataType: 'json',
            success: function (data) {
                options = '';
                if ($(target + " option").length > 0) {
                    options = $(target).find('option')[0].outerHTML;
                }
                $.each(data, function (id, item) {
                    options += "<option value= '" + id + "'>" + item + "</option>";
                });

                $(target).html(options);
                if ($(target).hasClass('get_data')); $(target).trigger("change");
                if ($(target).hasClass('get_child')); $(target).trigger("change");
            },
            error: function (xhr, textStatus, errorThrown) {
                alert("Error: " + errorThrown);
            }
        });
    }
});
$(document).on('change', "select.get_data", function (event) {
    event.preventDefault();
    let selectValue = $(this).val();
    target = $(this).data('target');
    let url = $(this).data('href');

    url = url.replace('value_new', selectValue);

    let addtion = $(this).data('addtion');
    if (addtion !== undefined) {
        addtion = addtion.split('|');
        addtion.forEach(function (elem) {
            elemValue = $('#' + elem).val();
            url += "&filter_" + elem + "=" + elemValue;
        });
    }

    $.get({
        url: url,
        cache: false,
        dataType: 'html',
        success: function (data) {
            $(target).html(data);
        },
        error: function (xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });


});

$(document).on('change', "select.get_fee_ship", function (event) {
    event.preventDefault();
    let url = $(this).data('href_fee');
    let _token = $('input[name="_token"]').val();
    var provinceId = $('#province_id').find(":selected").val();
    var districtId = $('#district_id').find(":selected").val();
    var wardId = $('#ward_id').find(":selected").val();
    $.ajax({
        url: url,
        method: "GET",
        dataType: 'html',
        data: {           
            provinceId: provinceId,
            districtId: districtId,
            wardId: wardId,
            _token: _token
        },
        success: function(data) {
             $('.checkout-list-product').html(data);
        },
    });  
});


