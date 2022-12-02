                  
<div style="width:800px;margin: 0px auto;border: solid 1px #dbd8d8;padding:5px 20px 5px 20px">
    <div style="font-size: 14px">
        <p style="font-style: italic;font-weight: bold">Thông báo STORE THỨC có đơn hàng mới</p>     
    </div>
    <p style="font-size: 18px">THÔNG TIN ĐƠN HÀNG: {{$data['code_order']}}</p>
    <hr style="border:solid 1px #dbd8d8">
    <div>
        <table cellpadding="5" cellspacing="0" border = "1" width="100%" style="font-size:15px; ">
            <tbody>
                <tr style="background-color:#20d144;color:#fff">
                    <th> THÔNG TIN ĐƠN HÀNG </th>
                </tr>
                <tr>
                    <td style="vertical-align:top">
                        Người nhận hàng: <strong style="color:#067461">{{$data['fullname']}}</strong><br>
                        Địa chỉ: <strong>{{$data['address']}}</strong><br> 
                        Điện thoại:<strong>{{$data['phone']}}</strong><br>
                        Email:<strong>{{$data['email']}}</strong><br>
                        Thông tin ghi chú:<strong>{{$data['note']}}</strong><br>
                    </td>
                </tr>   
            </tbody>
        </table>
        <p>Phương thức thanh toán: <span style="font-weight: bold">{{$data['payments']}}</span></p>
        <table cellpadding="5" cellspacing="0"  style="font-size:15px!important; border: none; table-layout: auto;width: 100%">
            <tbody style="background-color:#f5f0f0;">
                <tr style="background-color:#0fe93a;color:#fff">
                    <th>SẢN PHẨM</th>
                    <th>GIÁ SẢN PHẨM</th>
                    <th>SỐ LƯỢNG</th>
                    <th>THÀNH TIỀN</th>
                </tr>
                @foreach (Cart::content() as $item1)
                    <tr>
                        <td style="text-align:center;width: 35%">{{$item1->name}}</td>
                        <td style="text-align: center;width: 25%">{{number_format($item1->price, 0, ',', '.') }} đ</td>
                        <td style="text-align: center;width: 15%">{{$item1->qty}}</td>
                        <td style="text-align: center;width: 25%">{{number_format($item1->total, 0, ',', '.') }} đ</td>                                                                                        </td>
                    </tr> 
                @endforeach
                <tr>
                    <td colspan="2" style=" width:100%;text-align:right;padding:10px 0;"><span>Phí vận chuyển: </span></td>
                    <td colspan="2" style=" width:100%;text-align:right;padding:10px 0;"><span style="padding-right: 10px">0 đ</span></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style=" width:100%;text-align:right;padding:10px 0;"><span>Tổng giá trị sản phẩm: </span></td>
                    <td colspan="2" style=" width:100%;text-align:right;padding:10px 0;"><span style="padding-right: 10px; font-weight: bold">{{Cart::total()}} đ</span></td>
                </tr>
            </tfoot>
        </table>
    </div>                                                                                                                                              
</div>                                              

