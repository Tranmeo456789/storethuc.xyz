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

});
// detail img
$(document).ready(function() {
    $('.image-click').click(function() {
        //alert('ok');
        let pic_src = $(this).find('img').attr('src');
        $('#main-thumb img').attr('src', pic_src);
        $('.zoom').css('background-image', 'url(' + pic_src + ')');
        $('.image-click').removeClass('active-img-product');
        $(this).addClass('active-img-product');
        //return false;
    });
    $('#list-thumb .image-click:first').click();
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