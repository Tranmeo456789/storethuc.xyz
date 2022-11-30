<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Page;
use App\Product_cat;
use App\Product_cat_child;
use App\Quanhuyen;
use App\Slider;
use App\Tinhthanhpho;
use App\Xaphuongthitran;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartController extends Controller
{
    function __construct()
    {
        $pages=Page::all();
       $page_contact=Page::find(15);
       $page_introduce=Page::find(21);
        $_SESSION['cat_product']=Product_cat::all();
        $_SESSION['cat_product_child']=Product_cat_child::all();
        $_SESSION['product_sellign']=Product::inRandomOrder()->limit(8)->get();
        $_SESSION['slider']=Slider::orderBy('location')->where('status','Công khai')->get();
        $_SESSION['product']=Product::all();
    }
    
    
    function show(){
        $pages=Page::all();
       $page_contact=Page::find(15);
       $page_introduce=Page::find(21);
        // $_SESSION['cat_product']=Product_cat::all();
        // $_SESSION['cat_product_child']=Product_cat_child::all();
        // $_SESSION['product_sellign']=Product::inRandomOrder()->limit(8)->get();
        // $_SESSION['slider']=Slider::orderBy('location')->where('status','Công khai')->get();
        // $_SESSION['product']=Product::all();
        return view('client.cart.show',compact('pages','page_contact','page_introduce'));
    }
    function add(Request $request){
        $ida= (int)$request->input('id_product');
        $product1 = Product::find($ida);
        $qty_exist=0;
        foreach(Cart::content() as $row4){
                if($ida==$row4->id){
                    $qty_exist=$row4->qty;
                    $rowId_exist=$row4->rowId;
                }
            }    
        $qty1= (int)($request->input('num_order'));
        $qty_total=$qty_exist+$qty1;
             
        if($qty_total<11){
            Cart::add([
                'id' => $product1->id,
                'name' => $product1->name,
                'qty' => $qty1,
                'price' => $product1->price_current,
                'options' => ['slug'=>$product1->slug,'thumbnail'=>$product1->thumbnail,'unit'=>$product1->unit],
            ]);
        }else{
            //return   $qty_total;
            Cart::update($rowId_exist,10);
        }
            
        
            //return Cart::content();
            return redirect('show/cart');
    }
    function saveAjax(Request $request){
        $data=$request->all();
        $id=$data['id'];
        $product = Product::find($id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price_current,
            'options' => ['slug'=>$product->slug,'thumbnail'=>$product->thumbnail,'unit'=>$product->unit],
        ]);
    }
    function remove($rowId){
        Cart::remove($rowId);
        return redirect('show/cart');
    }
    function destroy(){
        Cart::destroy();
        return redirect('show/cart');
    }
    function update(Request $request){
        
        $data=$request->get('qty');
        foreach($data as $k=>$v){
            Cart::update($k,$v);
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
    function updateCartAjax(Request $request){
        $data=$request->all();
        $id=$data['id'];
        //$item=Product::find($id);
        $qty=$data['qty'];
        $rowId=$data['rowId'];
        Cart::update($rowId,$qty);
        $num_order=Cart::count();
        $sub_total=Cart::content()[$rowId]->total;
        // $sub_total=$item['price_current']*$qty;
        $rowa=[];
        $temp=0;
        foreach(Cart::content() as $row1){
            $temp++;
           if($temp<3){
            $rowa[]=$row1;
           }
        }
        $list_cat='
        <p class="desc">Có <span>'.Cart::count().' sản phẩm</span> trong giỏ hàng</p>
        <ul class="list-cart">';
        $temp=0;
        foreach(Cart::content() as $row1){
            $temp++;
            if($temp<3){
            $list_cat.='
            <li class="clearfix">
                <a href="" title="" class="thumb fl-left">
                    <img src="'.asset($row1->options->thumbnail).'" alt="">
                </a>
                    <div class="info fl-right">
                         <a href="'.route('cat1.product',$row1->options->slug).'" title="" class="product-name truncate2">'.$row1->name.'</a>
                        <p class="price mb-0">'.number_format($row1->price, 0, ',', '.') .'đ / '.$row1->options->unit.'</p>
                        <p class="qty mb-0">Số lượng: <span>'.$row1->qty.'</span></p>
                     </div>
            </li>';
            }
        }
        
        $list_cat.='</ul>
        <div class="total-price clearfix">
            <p class="title fl-left mb-0">Tổng:</p>
            <p class="price fl-right mb-0">'.Cart::total().'<span class="text-lowercase">đ</span></p>
        </div>
        <div class="action-cart clearfix">
            <a href="'.url('show/cart').'" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
            <a href="" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
        </div>';
        $result = array(
            'sub_total' => number_format($sub_total, 0, ',', '.'),
            'num_order' => $num_order ,
            'total_cart' => Cart::total(), 
            'list_cart' => $list_cat,     
        );
        
        echo json_encode($result);
        

    }

}
