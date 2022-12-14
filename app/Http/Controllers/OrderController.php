<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Jobs\SendMailToAdmin;
use App\Model\CatProductModel;
use App\Model\ProductModel;
use App\Model\OrderModel;
use App\Model\ProvinceModel;
use App\Mail\MailOrder;
use App\Mail\MailToAdmin;
use App\Model\DistrictModel;
use App\Model\WardModel;
use App\Order;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
    function __construct()
    {
    }
    
    function buynow($id){
        
        $product1 = ProductModel::find($id);
        $qty_exist=0;
        foreach(Cart::content() as $row4){
                if((int)$id == (int)$row4->id){
                    $qty_exist = (int)$row4->qty;
                    $rowId_exist = $row4->rowId;
                    
                }
            }    
           if(isset($rowId_exist)){
            Cart::content()[$rowId_exist]->qty = $qty_exist;
           }
            else{
            Cart::add([
                'id' => (int)$product1->id,
                'name' => $product1->name,
                'qty' => 1,
                'price' => $product1->price,
                'options' => ['slug'=>$product1->slug,'thumbnail'=>$product1->thumbnail, 'unit' => $product1->unitProduct->name],
            ]);
        }
            return redirect('thanh-toan');
    }
    function checkout(){
       $order_id_last=Order::latest('id')->first();
       $order_id=$order_id_last['id']+1;
       $city= ProvinceModel::orderBy('matp','asc')->get();
       
        return view('client.cart.checkout',compact('city','order_id'));
    }
    function locationAjax(Request $request){
        $data=$request->all();
        $output='';
        if($data['action']){
            if($data['action']=='city'){
                $output.='<option value="">--Chọn quận huyện--</option>';
                $select_province=DistrictModel::where('matp', $data['maid'])->orderBy('maqh','asc')->get();
                foreach($select_province as $item6){
                    $output.='<option value="'.$item6->maqh.'">'.$item6->name_huyen.'</option>';
                }
            }else{
                $output.='<option value="">--Chọn xã phường--</option>';
                $select_wards=WardModel::where('maqh', $data['maid'])->orderBy('xaid','asc')->get();
                foreach($select_wards as $item7){
                    $output.='<option value="'.$item7->xaid.'">'.$item7->name_xa.'</option>';
                }
            }
        }
        echo $output;
    }
    function OrderSuccess(Request $request){
        if($request->input('email')==''){
            $request->validate(
                [
                'fullname' => 'required|string|min:1',
                'phone' => 'required|numeric|min:1',
                'province'=> 'required',
                'district' =>'required',
                'ward' =>'required',
                'address'=>'required|string|min:1',
                ],
                [
                    'numeric' => 'Số điện thoại không hợp lệ',
                    'required'=>'Vui lòng :attribute',
                    'min'=>':attribute có độ dài ít nhất :min ký tự',                  
                ],
                [
                    'fullname'=>'nhập họ và tên',
                    'phone'=>'nhập số điện thoại',
                    'province'=> 'chọn tỉnh thành phố',
                    'district' =>'chọn quận huyện',
                    'ward' =>'chọn xã phường thị trấn',
                    'address' => 'nhập địa chỉ'
                ]
            );
        }else{
            $request->validate(
                [
                'fullname' => 'required|string|min:1',
                'phone' => 'required|numeric|min:1',
                'province'=> 'required',
                'district' =>'required',
                'ward' =>'required',
                'email' => 'email',
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
                    'province'=> 'chọn tỉnh thành phố',
                    'district' =>'chọn quận huyện',
                    'ward' =>'chọn xã phường thị trấn',
                    'address' => 'nhập địa chỉ',
                    'email'=>'Email',
                ]
            );
        }
        
        $params['note']=$request->input('note');
        $params['delivery_method']=$request->input('delivery_method');
        $params['total']=0;
        $params['total_product']=0;
        
        foreach(Cart::content() as $itemCart){           
            $params['info_product'][$itemCart->id]['product_id']=$itemCart->id;
            $params['info_product'][$itemCart->id]['name']=$itemCart->name;
            $params['info_product'][$itemCart->id]['price']=$itemCart->price;
            $params['info_product'][$itemCart->id]['total_money']=(int)$itemCart->subtotal;
            $params['info_product'][$itemCart->id]['quantity']=$itemCart->qty;
            $params['info_product'][$itemCart->id]['image']=$itemCart->options->thumbnail;
            $params['info_product'][$itemCart->id]['unit']=$itemCart->options->unit;

            $params['total']+=$itemCart->subtotal;
            $params['total_product']+=$itemCart->qty;
        }
        $province=(new ProvinceModel)->getItem(['matp'=>$request->input('province')],['task'=>'get-item-full']);
        $district=(new DistrictModel)->getItem(['maqh'=>$request->input('district')],['task'=>'get-item-full']);
        $ward=(new WardModel)->getItem(['xaid'=>$request->input('ward')],['task'=>'get-item-full']);
        $params['buyer']['gender']='Nam';
        $params['buyer']['fullname']=$request->input('fullname');
        $params['buyer']['phone']=$request->input('phone');
        $params['buyer']['email']=$request->input('email');
        $params['buyer']['address']=$request->input('address').', '.$ward['name_xa'].', '.$district['name_huyen'].', '.$province['name_tinh'];
        
        (new OrderModel)->saveItem($params,['task'=>'frontend-save-item']);
        $OrderLast=OrderModel::latest('id')->first();
        (new OrderModel)->saveItem(['id' => $OrderLast->id],['task'=>'frontend-save-code-order']);
        $OrderLast=OrderModel::latest('id')->first();
       
       
        // $data=[
        //     'code_order' => $OrderLast['code_order'],
        //     'fullname'=>$OrderLast['buyer']['fullname'],
        //     'email'=>$OrderLast['buyer']['email'],
        //     'address'=>$OrderLast['buyer']['address'],
        //     'phone'=>$OrderLast['buyer']['phone'],
        //     'note'=>$OrderLast['note'],
        //     'payments'=>$OrderLast['delivery_method'],
        // ];
        
        // if($request->input('email')){
        //     Mail::to($request->input('email'))->send(new MailOrder( $data));
        // }  
        //return($data);
        $data=[];
        $emailJob = new SendMailToAdmin();
        dispatch($emailJob);

        return redirect()->route('order.success', ['id'=>$OrderLast['id']]);
    }
    function viewOrderSuccess($id){
        //if($id==Str::lower(Order::latest('id')->first()['code_order'])){
         
        $order=(new OrderModel)->getItem(['id'=>$id],['task'=>'get-item-frontend']);
        Cart::destroy();
        $data='';
        //Mail::to('kieptuattuat@gmail.com')->send(new MailToAdmin($data));  
        //Mail::to('kieptuattuat@gmail.com')->later(now()->addSecond(5), new MailToAdmin($data)); 
        return view('client.order.orderSuccess',compact('order'));
        // }else{
        //     return view('client.page404');
        // }
    }
        

}
