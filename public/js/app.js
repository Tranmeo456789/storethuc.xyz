$(document).ready(function() {
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();

    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    $("input[name='checkall']").click(function() {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });

    $('#s').keyup(function() {
        var key_word = $('#s').val();
        var _token = $('input[name="_token"]').val();
        var url=$(this).attr('data-href');
        if (key_word != '') {
            $.ajax({
                url: url,
                method: "GET",
                dataType: 'html',
                data: {
                    key_word: key_word,
                    _token: _token
                },

                success: function(data) {
                    $(".suggest-search").html(data);
                },
            });
        } else {
            $(".suggest-search").html("");
        }

    });
});
//content product
$(document).on('click', "#show-hidden-content", function (event) {
    $('#post-product-wp').toggleClass('show-full');
    var x = $('#show-hidden-content').text();
    if (x === "Thu gọn") {
        $('#show-hidden-content').text('Xem thêm');
        $('#show-hidden-content').css('top', '92%');
            $('.bg-blur').css('display', 'block');
            $('body,html').stop().animate({
                scrollTop: 700
            }, 900);
        } else {
            $('#show-hidden-content').css('top', '100%');
            $('#show-hidden-content').text('Thu gọn');
            $('.bg-blur').css('display', 'none');
    }
});
// detail img
$(document).on('click', ".image-click", function (event) {
    let pic_src = $(this).find('img').attr('src');
    $('#main-thumb img').attr('src', pic_src);
    $('.zoom').css('background-image', 'url(' + pic_src + ')');
    $('.image-click').removeClass('active-img-product');
    $(this).addClass('active-img-product');
});
$('#list-thumb .image-click:first').click();
// change local
$(document).on('change', ".choose1", function (event) {
    var action = $(this).attr('id');
    var maid = $(this).val();
    var _token = $('input[name="_token"]').val();
    var result = '';
    var url=$(this).attr('data-href');
    if (action == 'city') {
        result = 'province';
    } else {
         result = 'wards';
        }
    $.ajax({
        url: url,
        method: "POST",
        dataType: 'html',
        data: {
            action: action,
            maid: maid,
             _token: _token
             },

        success: function(data) {
             $('#' + result).html(data);
        },
        error: function(xhr, ajaxOptions, thrownError) {
         alert(xhr.status);
        alert(thrownError);
        }
    });
});
// zoom img 
function zoom(event) {
    var zoomer = event.currentTarget;
    x = event.offsetX / zoomer.offsetWidth * 100;
    y = event.offsetY / zoomer.offsetHeight * 100;
    zoomer.style.backgroundPosition = x + '% ' + y + '%';
}
// zoom img mobi
function zoom(e) {
    var zoomer = e.currentTarget;
    e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
    e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
    x = offsetX / zoomer.offsetWidth * 100
    y = offsetY / zoomer.offsetHeight * 100
    zoomer.style.backgroundPosition = x + '% ' + y + '%';
}
/* FORM LOGIN */

$(document).on('click', ".icon-eye", function (event) {
    $('.icon-eye i').toggleClass("fa-eye-slash");
   
});
const ipnElement = document.querySelector('.wp-input-icon #password');
const btnElement = document.querySelector('.wp-input-icon .icon-eye');
btnElement.addEventListener('click', function() {
  const currentType = ipnElement.getAttribute('type');
  ipnElement.setAttribute(
    'type',
    currentType === 'password' ? 'text' : 'password'
  )
});
