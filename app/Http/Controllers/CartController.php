<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\ProductModel;

use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    function __construct()
    {
        
    }
    function show()
    {
        return view('client.cart.show');
    }
    function add(Request $request)
    {
        $ida = (int)$request->input('id_product');
        $product1 = ProductModel::find($ida);
        $qty_exist = 0;
        foreach (Cart::content() as $row4) {
            if ((int)$ida == (int)$row4->id) {
                $qty_exist = $row4->qty;
                $rowId_exist = $row4->rowId;
            }
        }
        $qty1 = (int)($request->input('num_order'));
        $qty_total = $qty_exist + $qty1;
        if (isset($rowId_exist)) {
            Cart::content()[$rowId_exist]->qty = $qty1;
        } else {
            Cart::add([
                'id' => (int)$product1->id,
                'name' => $product1->name,
                'qty' => $qty1,
                'price' => $product1->price,
                'options' => ['slug' => $product1->slug, 'thumbnail' => $product1->thumbnail, 'unit' => $product1->unitProduct->name],
            ]);
        }
        return redirect('show/cart');
    }
    function saveAjax(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $product = ProductModel::find($id);
        $qty_exist = 0;
        foreach (Cart::content() as $row4) {
            if ((int)$id == (int)$row4->id) {
                $qty_exist = (int)$row4->qty;
                $rowId_exist = $row4->rowId;
            }
        }
        if (isset($rowId_exist)) {
            Cart::content()[$rowId_exist]->qty = $qty_exist;
        } else {
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
                'options' => ['slug' => $product->slug, 'thumbnail' => $product->thumbnail, 'unit' => $product->unitProduct->name],
            ]);
        }
    }
    function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect('show/cart');
    }
    function destroy()
    {
        Cart::destroy();
        return redirect('show/cart');
    }
    function update(Request $request)
    {

        $data = $request->get('qty');
        foreach ($data as $k => $v) {
            Cart::update($k, $v);
        }
        // $temp=0;
        // foreach(Cart::content() as $row1){
        //     $temp++;
        //    if($temp<3){
        //     $rowa[]=$row1;
        //    }
        // }
        //return $rowa[0]->options->thumbnail;
        return redirect('show/cart');
    }
    function updateCartAjax(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $qty = $data['qty'];
        $rowId = $data['rowId'];
        Cart::update($rowId, $qty);
        $num_order = Cart::count();
        $sub_total = Cart::content()[$rowId]->total;
        // $sub_total=$item['price_current']*$qty;
        $rowa = [];
        $temp = 0;
        foreach (Cart::content() as $row1) {
            $temp++;
            if ($temp < 3) {
                $rowa[] = $row1;
            }
        }
        $list_cat = '
        <p class="desc">C?? <span>' . Cart::count() . ' s???n ph???m</span> trong gi??? h??ng</p>
        <ul class="list-cart">';
        $temp = 0;
        foreach (Cart::content() as $row1) {
            $temp++;
            if ($temp < 3) {
                $list_cat .= '
            <li class="clearfix">
                <a href="" title="" class="thumb fl-left">
                    <img src="' . asset($row1->options->thumbnail) . '" alt="">
                </a>
                    <div class="info fl-right">
                        <a href="' . route('cat1.product', $row1->options->slug) . '" title="" class="product-name truncate2">' . $row1->name . '</a>
                        <p class="price mb-0">' . number_format($row1->price, 0, ',', '.') . '?? / ' . $row1->options->unit . '</p>
                        <p class="qty mb-0">S??? l?????ng: <span>' . $row1->qty . '</span></p>
                     </div>
            </li>';
            }
        }

        $list_cat .= '</ul>
        <div class="total-price clearfix">
            <p class="title fl-left mb-0">T???ng:</p>
            <p class="price fl-right mb-0">' . Cart::total() . '<span class="text-lowercase">??</span></p>
        </div>
        <div class="action-cart clearfix">
            <a href="' . url('show/cart') . '" title="Gi??? h??ng" class="view-cart fl-left">Gi??? h??ng</a>
            <a href="" title="Thanh to??n" class="checkout fl-right">Thanh to??n</a>
        </div>';
        $result = array(
            'sub_total' => number_format($sub_total, 0, ',', '.'),
            'num_order' => $num_order,
            'total_cart' => Cart::total(),
            'list_cart' => $list_cat,
        );

        echo json_encode($result);
    }
}
