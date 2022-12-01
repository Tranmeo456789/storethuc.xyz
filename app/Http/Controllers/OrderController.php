<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\Page;
use App\Product_cat;
use App\Product_cat_child;
use App\Quanhuyen;
use App\Slider;
use App\Tinhthanhpho;
use App\Xaphuongthitran;
use App\Guest;
use App\Mail\MailOrder;
use App\Order;
use App\Product_order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
    function __construct()
    {
       
        $_SESSION['cat_product']=Product_cat::all();
        $_SESSION['cat_product_child']=Product_cat_child::all();
        $_SESSION['product_sellign']=Product::inRandomOrder()->limit(8)->get();
        $_SESSION['slider']=Slider::orderBy('location')->where('status','Công khai')->get();
        $_SESSION['product']=Product::all();
    }
    
    function buynow($id){
        $product1 = Product::find($id);
        $qty_exist=0;
        foreach(Cart::content() as $row4){
                if($id==$row4->id){
                    $qty_exist=$row4->qty;
                    $rowId_exist=$row4->rowId;
                }
            }    
        $qty1= 1;
        $qty_total=$qty_exist+$qty1;
             
        if($qty_total<11){
            Cart::add([
                'id' => $product1->id,
                'name' => $product1->name,
                'qty' => $qty1,
                'price' => $product1->price_current,
                'options' => ['slug'=>$product1->slug,'thumbnail'=>$product1->thumbnail],
            ]);
        }else{
            Cart::update($rowId_exist,10);
        }

            return redirect('thanh-toan');
    }
    function checkout(){
        $pages=Page::all();
       $page_contact=Page::find(15);
       $page_introduce=Page::find(21);
       $order_id_last=Order::latest('id')->first();
       $order_id=$order_id_last['id']+1;
       $city= Tinhthanhpho::orderBy('matp','asc')->get();
       
        return view('client.cart.checkout',compact('pages','page_contact','page_introduce','city','order_id'));
    }
    function locationAjax(Request $request){
        $data=$request->all();
        $output='';
        if($data['action']){
            if($data['action']=='city'){
                $output.='<option value="">--Chọn quận huyện--</option>';
                $select_province=Quanhuyen::where('matp', $data['maid'])->orderBy('maqh','asc')->get();
                foreach($select_province as $item6){
                    $output.='<option value="'.$item6->maqh.'">'.$item6->name_huyen.'</option>';
                }
            }else{
                $output.='<option value="">--Chọn xã phường--</option>';
                $select_wards=Xaphuongthitran::where('maqh', $data['maid'])->orderBy('xaid','asc')->get();
                foreach($select_wards as $item7){
                    $output.='<option value="'.$item7->xaid.'">'.$item7->name_xa.'</option>';
                }
            }
        }
        echo $output;
    }
    function OrderSuccess(Request $request){
        $request->validate(
            [
            'fullname' => 'required|string|min:1',
            'phone' => 'required|numeric|min:1',
            //'email' => 'email',
            'city'=> 'required',
            'province' =>'required',
            'wards' =>'required',
            'address'=>'required|string|min:1',
            ],
            [
                'numeric' => 'Số điện thoại không hợp lệ',
                'required'=>'Vui lòng :attribute',
                'email'=> ':attribute không hợp lệ',
                'min'=>':attribute có độ dài ít nhất :min ký tự',                  
            ],
            [
                'fullname'=>'nhập họ và tên',
                'phone'=>'nhập số điện thoại',
                'email'=>'Email',
                'city'=> 'chọn tỉnh thành phố',
                'province' =>'chọn quận huyện',
                'wards' =>'chọn xã phường thị trấn',
                'address' => 'nhập địa chỉ'
            ]
        );
        $city=Tinhthanhpho::where('matp',$request->input('city'))->get();
        $province=Quanhuyen::where('maqh',$request->input('province'))->get();
        $wards=Xaphuongthitran::where('xaid',$request->input('wards'))->get();
        
        $price_total=0;
        foreach(Cart::content() as $item9){
            $price_total+=$item9->total;
        }
        
        Order::create(
            [    
                'fullname' => $request->input('fullname'),
                'price_total' => $price_total,
                'status'=> 'Đang xử lý',
                'note'=>$request->input('note'),  
                'payments'=>$request->input('payment-method'),      
            ]
          );
           $order_id_last=Order::latest('id')->first();
           $order_code='ISM-'.($order_id_last['id']).Str::upper(Str::random(9));
          Order::where('id', $order_id_last['id'])->update(
            [    
                'code_order' => $order_code,     
            ]
          );
        Guest::create(
            [                
                'fullname' => $request->input('fullname'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'address' => $request->input('address').', '.$wards[0]['name_xa'].', '.$province[0]['name_huyen'].', '.$city[0]['name_tinh'],
                'order_id' => $order_id_last['id'],                  
            ]
          );
        foreach(Cart::content() as $item7){
            Product_order::create(
                [                
                    'order_id' => $order_id_last['id'],
                    'product_id' => $item7->id,
                    'qty' => $item7->qty,                  
                ]
            );
        }
        $guests=Guest::where('order_id',$order_id_last['id'])->get();
        $guest=$guests[0];
        $order=Order::where('id',$order_id_last['id'])->get();
        $data=[
            'code_order' => $order[0]->code_order,
            'fullname'=>$guest->fullname,
            'email'=>$guest->email,
            'address'=>$guest->address,
            'phone'=>$guest->phone,
            'phone'=>$guest->phone,
            'note'=>$order[0]->note,
            'payments'=>$order[0]->payments,
        ];
        if($request->input('email')){
            Mail::to($request->input('email'))->send(new MailOrder( $data));
        }  
        Mail::to('storethuc@gmail.com')->send(new MailOrder( $data));    
        return redirect()->route('order.success', ['id'=>Str::lower(Order::latest('id')->first()['code_order'])]);
    }
    function OrderSuccess1($id){
        if($id==Str::lower(Order::latest('id')->first()['code_order'])){
            $pages=Page::all();
            $page_contact=Page::find(15);
            $page_introduce=Page::find(21);
            $guests=Guest::where('order_id',Order::latest('id')->first()['id'])->get();
        $guest=$guests[0];
        $order=Order::where('id',Order::latest('id')->first()['id'])->get();
            $data=[
                'code_order' => $order[0]->code_order,
                'fullname'=>$guest->fullname,
                'email'=>$guest->email,
                'address'=>$guest->address,
                'phone'=>$guest->phone,
                'phone'=>$guest->phone,
                'note'=>$order[0]->note,
                'payments'=>$order[0]->payments,
            ];
            $id=Order::latest('id')->first()['id'];
            $product_order=[];
        $product_orders=Product_order::all();
        foreach($product_orders as $item7){
            if($id==$item7->order_id){
                $product_order[]=$item7;
            }
        }
        
        $product=[];
        $qty_total=0;
        $products=Product::all();
        foreach($product_order as $item9){
            foreach($products as $item10){
                if($item9->product_id==$item10->id){
                    $qty_total+=$item9->qty;
                   $itema= json_decode($item9, true);
                   $itemb=json_decode($item10, true);
                    $product[]= array_merge($itema,$itemb);
                }
            }
        }
         $orders=Order::withTrashed()->where('id',$id)->get();
         foreach($orders as $itemorder){
             $order=$itemorder;
         }
             Cart::destroy();
            return view('client.order.orderSuccess',compact('pages','page_contact','page_introduce','data','product','qty_total','order'));
        }else{
            return view('client.page404');
        }
    }
        

}
