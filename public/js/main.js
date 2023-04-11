
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
    $('#plus').click(function () {
        if (value < 10) {
            value++;
            $('#num-order').attr('value', value);
        }
        //update_href(value);
    });
    $('#minus').click(function () {
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