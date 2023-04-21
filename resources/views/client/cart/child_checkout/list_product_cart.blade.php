@php
use App\Model\FeeShipModel;

$feeShipAll=(new FeeShipModel)->getItem(['id'=>1],['task'=>'get-item'])->fee_ship;

$feeShip = $feeDetail ?? $feeShipAll;
$total = 0;
@endphp
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
                @php
                    $total+=$row->total;
                @endphp
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="cart-item">
                <td class="product-name text-secondary">C<span style="text-transform: lowercase">hi phí vận chuyển</span></td>
                <td class="product-total">
                    <span style="text-transform: lowercase" class="text-dark">{{ number_format($feeShip, 0, ',', '.') }} đ</span>
                    <input type="hidden" name="value_fee_ship" value="{{$feeShip}}">
            </td>
            </tr>
            <tr class="order-total">
                <td style="width:70%">Tổng đơn hàng:</td>
                <td><strong class="total-price">{{ number_format($total+$feeShip, 0, ',', '.') }} <span style="text-transform: lowercase">đ</span></strong></td>
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