<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Social;
use Illuminate\Contracts\Session\Session;
//use Laravel\Socialite\Facades\Socialite as FacadesSocialite;
use Socialite; 

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next){
            session(['module_active'=>'dashboard']);
            return $next($request);
        });
    }

    function show(){
        $orders=Order::orderBy('updated_at','desc')->whereNull('status_delete')->paginate(5);
        $sales=0;
        foreach(Order::all() as $orderitem){
            $sales+=$orderitem->price_total;
        }
        $count_complete=Order::where('status','LIKE',"Hoàn thành")->count();
        $count_move=Order::where('status','LIKE',"Đang vận chuyển")->count();
        $count_processing=Order::where('status','LIKE',"Đang xử lý")->count();
        $count_cancel=Order::where('status','LIKE',"Hủy")->count();
        $count=[$count_complete,$count_move,$count_processing,$count_cancel];
        return view('admin.dashboard',compact('orders','sales','count'));
    }
    
      
              
}
