<script src="https://connect.facebook.net/vi_VN/sdk.js?hash=ce25f2a893e29e713de6a0e16d3a901f" async="" crossorigin="anonymous"></script>
<script id="facebook-jssdk" src="//connect.facebook.net/vi_VN/sdk.js#xfbml=1&amp;version=v2.8&amp;appId=849340975164592"></script>
<script src="{{asset('js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/elevatezoom-master/jquery.elevatezoom.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/carousel/owl.carousel.js')}}" type="text/javascript"></script>
<script src="{{asset('js/main.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" defer></script>

{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  --}}
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>

<script>
    //update cart ajax
    $('.minus1').click(function() {
        if (Number($(this).next('.num-order').val()) > 1) {
            var num_per_product = Number($(this).next('.num-order').val()) - 1;
            $(this).next('.num-order').val(num_per_product);
            var qty = $(this).next('.num-order').val();
            var id = $(this).next('.num-order').attr("data-id");
            var rowId = $(this).next('.num-order').attr("data-rowId");
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('cart/updateCartAjax')}}",
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
                    $("#num").text(data.num_order);
                    $("#num1").text(data.num_order);
                    $("#total-cart").text(data.total_cart);
                    $('#dropdown').html(data.list_cart);
                },
            });
        }

    });
    $('.plus1').click(function() {
        if (Number($(this).prev('.num-order').val()) < 10) {
            var num_per_product = Number($(this).prev('.num-order').val()) + 1;
            $(this).prev('.num-order').val(num_per_product);
            var qty = $(this).prev('.num-order').val();
            var id = $(this).prev('.num-order').attr("data-id");
            var rowId = $(this).prev('.num-order').attr("data-rowId");
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('cart/updateCartAjax')}}",
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
                    $("#num").text(data.num_order);
                    $("#num1").text(data.num_order);
                    $("#total-cart").text(data.total_cart);
                    $('#dropdown').html(data.list_cart);
                },
            });
        }
    });
    $('.num-order').change(function() {
        var qty = $(this).val();
        var id = $(this).attr("data-id");
        var rowId = $(this).attr("data-rowId");
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{url('cart/updateCartAjax')}}",
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
                $("#num").text(data.num_order);
                $("#total-cart").text(data.total_cart);
                $('#dropdown').html(data.list_cart);
            },
        });
    });
    $('.add-cart').click(function() {
        var id = $(this).attr("data-id");
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{url('saveAjax/cart')}}",
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
                            window.location.href = "{{url('show/cart')}}";
                        } else {
                            window.location.reload();
                        }
                    });
            },
            // error: function(xhr, ajaxOptions, thrownError) {
            //     alert(xhr.status);
            //     alert(thrownError);
            // }

        });

    });
</script>


