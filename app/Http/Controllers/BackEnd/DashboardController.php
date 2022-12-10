<?php


namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Model\OrderModel;
use App\Model\ProductModel;
use App\Helpers\MyFunction;
use App\Http\Controllers\BackEnd\BackEndController;
use DB;
class DashboardController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'dashboard';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Thống kê bán hàng';
        parent::__construct();
    }
    public function index(Request $request){
        $params['day']=date("Y-m-d");$sum_money_day=0;$sum_quantity=0; $sum_money=0;     
        $order_day=(new OrderModel)->listItems($params, ['task' => 'user-list-items-in-day']);
        if(!empty($order_day)){
            $sum_money_day = $order_day->sum('total');
        }     
        //$sum_quantity=(new ProductModel())->sumNumberItems($params, ['task' => 'sum-quantity-product-in-warehouse-of-user-id']);
        //$sum_money=(new ProductModel())->sumNumberItems($params, ['task' => 'sum-money-product-in-warehouse-of-user-id']);
        $sum_quantity=10;$sum_money=12;
        $itemOrder=(new OrderModel())->listItems(null, ['task' => 'user-list-items']);
         if(!empty($itemOrder)){
             $total_revenue=$itemOrder->sum('total');
         }
        return view($this->pathViewController .  'index',compact('order_day','sum_money_day','sum_quantity','sum_money','total_revenue'));
    }
    public function filterInDay(Request $request){
        $data = $request->all();
        $day_start=$request->day_start;
        $day_end=$request->day_end;
        $params['filter_in_day']['day_start']=MyFunction::formatDateLikeMySQL($day_start);
        $params['filter_in_day']['day_end']=MyFunction::formatDateLikeMySQL($day_end);
        $itemOrder=(new OrderModel())->listItems($params, ['task' => 'user-list-items']);
        $total_revenue=0;
        if(!empty($itemOrder)){
            $total_revenue=$itemOrder->sum('total');
        }
        $result = array(  
             'total_revenue'=>$total_revenue
          );
          return response()->json($result, 200);
        //   return view($this->pathViewController.'child_index.revenue_sell', [
        //     'total_revenue' => $total_revenue,
        // ]);
    }
}
