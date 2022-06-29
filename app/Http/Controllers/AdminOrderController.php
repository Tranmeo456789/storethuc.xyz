<?php

namespace App\Http\Controllers;

use App\Guest;
use App\Order;
use App\Product;
use App\Product_order;
use App\User;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next){
            session(['module_active'=>'order']);
            return $next($request);
        });
    }
    function detail($id){
        $orders=Order::where('id',$id)->get();
        $order=$orders[0];
        //return $order;
        $guests=Guest::where('order_id',$id)->get();
        // foreach($guests as $item6){
        //     if($id==$item6->order_id){
        //         $guest=$item6;
        //     }
        // }
        $guest=$guests[0];
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
        $status=$order->status;
        $list_status=['Đang xử lý','Đang vận chuyển','Hoàn thành','Hủy đơn'];
        foreach( $list_status as $k=>$status1){
            if($status==$status1){
                $i=$k;
                unset($list_status[$i]);
            }
        }
        //return $product[0];
        return view('admin.order.detail',compact('order','guest','product','qty_total','list_status','status'));
    }
    function update_status(Request $request,$id){
        $orders=Order::where('id',$id)->get();
        if($orders[0]->status==$request->input('status_order')){
            return redirect()->route('order.detail', ['id'=>$id]);
        }else{
            Order::where('id',$id)->update(
                [                
                    'status'=>$request->input('status_order'),
                ]
              );
            return redirect()->route('order.detail', ['id'=>$id])->with('status','Trạng thái được cập nhật thành công');
        }
         
    }
    function list(Request $request){ 
        $complete=0;$move=0;$processing=0;$cancel=0;$trash=0;
        $list_act=[
            'complete'=> 'Hoàn thành',
            'move'=>'Đang vận chuyển',
            'processing'=>'Đang xử lý',
            'cancel'=>'Hủy đơn',
            'trash'=>'Xóa tạm thời'
        ];
        $keyword_order="";
        if($request->input('search_user_order')){
            $keyword_order=$request->input('keyword_order');
        }
        $order_user_deletes=Order::withoutTrashed()->where('status_user','LIKE', "User đã bị xóa")->get();
         $orders=Order::orderBy('updated_at','desc')->where([
            ['fullname', 'LIKE', "%{$keyword_order}%"],
            ])->whereNull('status_delete')->paginate(10);
        //return $orders;
        $count_complete=Order::where('status','LIKE',"Hoàn thành")->count();
        $count_move=Order::where('status','LIKE',"Đang vận chuyển")->count();
        $count_processing=Order::where('status','LIKE',"Đang xử lý")->count();
        $count_cancel=Order::where('status','LIKE',"Hủy")->count();
        $count_trash=Order::onlyTrashed()->count();
        $count=[$count_complete,$count_move,$count_processing,$count_cancel,$count_trash];
        return view('admin.order.list', compact('orders','order_user_deletes','count','list_act','complete','processing','cancel','trash','move'));
    }
    // function search_order(Request $request){
    //     $keyword_order="";
    //     $orders=Order::paginate(10);
    //     if($request->input('search_user_order')){
    //         $keyword_order=$request->input('keyword_order');
    //         $order_users=User::where('name', 'LIKE', "%{$keyword_order}%")->get();
    //     }
    //     $orders=Order::join('users', 'users.id','=','orders.user_id')
    //     ->where('users.name', 'LIKE', "%{$keyword_order}%")->paginate(10);
       
    //     return view('admin.order.list', compact('orders','order_users','keyword_order'));
    // }
    function list_complete(Request $request){
        $complete=1;$move=0;$processing=0;$cancel=0;$trash=0;
        $list_act=[
            'move'=>'Đang vận chuyển',
            'processing'=>'Đang xử lý',
            'cancel'=>'Hủy đơn',
            'trash'=>'Xóa tạm thời',
        ];
        $keyword_order="";
        if($request->input('search_user_order')){
            $keyword_order=$request->input('keyword_order');
        }
        $orders=Order::orderBy('updated_at','desc')->where([
            ['fullname', 'LIKE', "%{$keyword_order}%"],
            ['status', 'LIKE', "Hoàn thành"],
            ])->whereNull('status_delete')->paginate(10);
        $count_complete=Order::where('status','LIKE',"Hoàn thành")->count();
        $count_move=Order::where('status','LIKE',"Đang vận chuyển")->count();
        $count_processing=Order::where('status','LIKE',"Đang xử lý")->count();
        $count_cancel=Order::where('status','LIKE',"Hủy")->count();
        $count_trash=Order::onlyTrashed()->count();
        $count=[$count_complete,$count_move,$count_processing,$count_cancel,$count_trash];
        return view('admin.order.list', compact('orders','count','list_act','complete','processing','cancel','trash','move'));
    }
    function list_move(Request $request){
        $complete=0;$move=1;$processing=0;$cancel=0;$trash=0;
        $list_act=[
            'complete'=>'Hoàn thành',
            'processing'=>'Đang xử lý',
            'cancel'=>'Hủy đơn',
            'trash'=>'Xóa tạm thời',
        ];
        $keyword_order="";
        if($request->input('search_user_order')){
            $keyword_order=$request->input('keyword_order');
        }
        $orders=Order::orderBy('updated_at','desc')->where([
            ['fullname', 'LIKE', "%{$keyword_order}%"],
            ['status', 'LIKE', "Đang vận chuyển"],
            ])->whereNull('status_delete')->paginate(10);
        $count_complete=Order::where('status','LIKE',"Hoàn thành")->count();
        $count_move=Order::where('status','LIKE',"Đang vận chuyển")->count();
        $count_processing=Order::where('status','LIKE',"Đang xử lý")->count();
        $count_cancel=Order::where('status','LIKE',"Hủy")->count();
        $count_trash=Order::onlyTrashed()->count();
        $count=[$count_complete,$count_move,$count_processing,$count_cancel,$count_trash];
        return view('admin.order.list', compact('orders','count','list_act','complete','processing','cancel','trash','move'));
    }
    function list_processing(Request $request){
        $complete=0;$move=0;$processing=1;$cancel=0;$trash=0;
        $list_act=[
            'complete'=>'Hoàn thành',
            'move'=>'Đang vận chuyển',
            'cancel'=>'Hủy đơn',
            'trash'=>'Xóa tạm thời',
        ];
        $keyword_order="";
        if($request->input('search_user_order')){
            $keyword_order=$request->input('keyword_order');
        }
        $orders=Order::orderBy('updated_at','desc')->where([
            ['fullname', 'LIKE', "%{$keyword_order}%"],
            ['status', 'LIKE', "Đang xử lý"],
            ])->whereNull('status_delete')->paginate(10);
        $count_complete=Order::where('status','LIKE',"Hoàn thành")->count();
        $count_move=Order::where('status','LIKE',"Đang vận chuyển")->count();
        $count_processing=Order::where('status','LIKE',"Đang xử lý")->count();
        $count_cancel=Order::where('status','LIKE',"Hủy")->count();
        $count_trash=Order::onlyTrashed()->count();
        $count=[$count_complete,$count_move,$count_processing,$count_cancel,$count_trash];
        return view('admin.order.list', compact('orders','count','list_act','complete','processing','cancel','trash','move'));
    }
    function list_cancel(Request $request){
        
        $complete=0;$move=0;$processing=0;$cancel=1;$trash=0;
        $list_act=[
            'complete'=>'Hoàn thành',
            'move'=>'Đang vận chuyển',
            'processing'=>'Đang xử lý',
            'trash'=>'Xóa tạm thời',
        ];
        $keyword_order="";
        if($request->input('search_user_order')){
            $keyword_order=$request->input('keyword_order');
        }
        $orders=Order::orderBy('updated_at','desc')->where([
            ['fullname', 'LIKE', "%{$keyword_order}%"],
            ['status', 'LIKE', "Hủy"],
            ])->whereNull('status_delete')->paginate(10);
        $count_complete=Order::where('status','LIKE',"Hoàn thành")->count();
        $count_move=Order::where('status','LIKE',"Đang vận chuyển")->count();
        $count_processing=Order::where('status','LIKE',"Đang xử lý")->count();
        $count_cancel=Order::where('status','LIKE',"Hủy")->count();
        $count_trash=Order::onlyTrashed()->count();
        $count=[$count_complete,$count_move,$count_processing,$count_cancel,$count_trash];
        return view('admin.order.list', compact('orders','count','list_act','complete','processing','cancel','trash','move'));
    }
    function list_trash(Request $request){
        $complete=0;$move=0;$processing=0;$cancel=0;$trash=1;
        $list_act=[
            'restore'=>'Khôi phục',
            'forcedelete'=>'Xóa vĩnh viễn',
        ];
        $keyword_order="";
        if($request->input('search_user_order')){
            $keyword_order=$request->input('keyword_order');
        }
        $orders=Order::orderBy('updated_at','desc')->where([
            ['fullname', 'LIKE', "%{$keyword_order}%"],
            ])->onlyTrashed()->paginate(10);
        $count_complete=Order::where('status','LIKE',"Hoàn thành")->count();
        $count_move=Order::where('status','LIKE',"Đang vận chuyển")->count();
        $count_processing=Order::where('status','LIKE',"Đang xử lý")->count();
        $count_cancel=Order::where('status','LIKE',"Hủy")->count();
        $count_trash=Order::onlyTrashed()->count();
        $count=[$count_complete,$count_move,$count_processing,$count_cancel,$count_trash];
        return view('admin.order.list', compact('orders','count','list_act','complete','processing','cancel','trash','move'));
    }
    function delete($id){
        $this->authorize('delete_order');
        Order::find($id)->delete();
        Order::withTrashed()->where('id', $id)->update(['status_delete' => "Xóa tạm thời"]);
        return redirect('admin/order/list')->with('status', 'Đơn hàng đã cho vào thùng rác');
    }
    function forcedelete($id){
        $this->authorize('delete_order');
        Order::withTrashed()
        ->where('id',$id)
        ->forceDelete();
        return redirect('admin/order/list')->with('status', 'Bạn đã xóa đơn hàng vĩnh viễn');
    }
    function action(Request $request){
        $list_check=$request->input('list_check');
        if(!empty($list_check)){
            $act=$request->input('act');
            if($act=='complete'){
                foreach($list_check as $id){
                    if(Order::where('id', $id) && Order::where('status', "Hoàn thành")){
                        unset($list_check[$id]);
                    }
                    Order::where('id', $id)->update(
                        [                
                            'status' => "Hoàn thành",        
                        ]
                      );
                } 
                return redirect('admin/order/list')->with('status', 'Trạng thái được chuyển thành công');      
            }
            if($act=='move'){
                foreach($list_check as $id){
                    if(Order::where('id', $id) && Order::where('status', "Đang vận chuyển")){
                        unset($list_check[$id]);
                    }
                    Order::where('id', $id)->update(
                        [                
                            'status' => "Đang vận chuyển",        
                        ]
                      );
                } 
                return redirect('admin/order/list')->with('status', 'Trạng thái được chuyển thành công');      
            }
            if($act=='processing'){
                foreach($list_check as $id){
                    if(Order::where('id', $id) && Order::where('status', "Đang xử lý")){
                        unset($list_check[$id]);
                    }
                    Order::where('id', $id)->update(
                        [                
                            'status' => "Đang xử lý",        
                        ]
                      );
                } 
                return redirect('admin/order/list')->with('status', 'Trạng thái được chuyển thành công');      
            }
            if($act=='cancel'){
                foreach($list_check as $id){
                    if(Order::where('id', $id) && Order::where('status', "Hủy")){
                        unset($list_check[$id]);
                    }
                    Order::where('id', $id)->update(
                        [                
                            'status' => "Hủy",        
                        ]
                      );
                } 
                return redirect('admin/order/list')->with('status', 'Trạng thái được chuyển thành công');      
            }
            if($act=='delete'){   
                $this->authorize('delete_product');            
                    Order::destroy($list_check);
                    Order::withTrashed()->whereIn('id',$list_check)->update(['status_delete' => "Xóa tạm thời"]);
                    return redirect('admin/order/list')->with('status', 'Bản ghi đã đưa vào thùng rác');     
                }
            if($act=='forcedelete'){   
                $this->authorize('delete_product');            
                    Order::withTrashed()
                    ->whereIn('id',$list_check)
                    ->forceDelete();
                    return redirect('admin/order/list')->with('status', 'Bản ghi đã xóa vĩnh viễn');     
                }  
            if($act=='restore'){               
                    Order::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                    Order::whereIn('id',$list_check)->update(['status_delete' => ""]);
                    return redirect('admin/order/list')->with('status', 'Bạn đã khôi phục thành công');     
            }
            if($act =='start'){
                return redirect('admin/order/list')->with('status', 'Bạn cần chọn tác vụ để thực hiện');
             }
        }
        else
        {
            return redirect('admin/order/list')->with('status', 'Bạn cần chọn phần tử để thực hiện');
        }
    }
}
