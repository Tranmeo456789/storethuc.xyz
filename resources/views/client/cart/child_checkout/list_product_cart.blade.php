<div class="section-head">
    <h1 class="section-title">Thông tin đơn hàng</h1>
</div>
<div class="section-detail">
    <table class="shop-table">
        <thead>
            <tr>
                <td>Sản phẩm</td>
                <td>Tổng</td>
            </tr>
        </thead>

        <tbody>
            @foreach (Cart::content() as $row)
            <tr class="cart-item">
                <td class="product-name">{{$row->name}}<strong class="product-quantity">x {{$row->qty}}</strong></td>
                <td class="product-total">{{ number_format($row->total, 0, ',', '.') }} đ</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="order-total">
                <td style="width:70%">Tổng đơn hàng:</td>
                <td><strong class="total-price">{{ Cart::total() }} <span style="text-transform: lowercase">đ</span></strong></td>
            </tr>
        </tfoot>
    </table>
    <div id="payment-checkout-wp">
        <ul id="payment_methods">
            <li>
                <input type="radio" id="payment-home" name="delivery_method" value="Thanh toán tại nhà" checked="checked">
                <label for="payment-home">Thanh toán tại nhà</label>
            </li>
        </ul>
    </div>
    <div class="place-order-wp clearfix">
        <input type="submit" id="order-now" name="btnOrder" value="Đặt hàng">
    </div>
</div>