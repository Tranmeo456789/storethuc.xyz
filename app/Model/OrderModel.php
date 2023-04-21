<?php
namespace App\Model;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\BackEndModel;
use Illuminate\Support\Str;

use App\Model\ProductModel;

use App\Model\CustomerShopModel;
use App\Model\ProductWarehouseModel;
use DB;
use Session;
class OrderModel extends BackEndModel
{
    protected $casts = [
        'info_product'   => 'array',       
        'buyer'   => 'array',
    ];
    public function __construct() {
        $this->table               = 'order';
        $this->controllerName      = 'order';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }
    public function search($query,$params){
        if (isset($params['search']['value'] ) && ($params['search']['value'] !== "")) {
            if($params['search']['field'] == "all") {
                $query->where(function($query) use ($params){
                    foreach($this->fieldSearchAccepted as $column){
                        $query->orWhereRaw("LOWER($column)" . ' LIKE BINARY ' .  "LOWER('%{$params['search']['value']}%')" );
                    }
                });
            } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->whereRaw("LOWER({$params['search']['field']})" . " LIKE BINARY " .  "LOWER('%{$params['search']['value']}%')" );
            }
        }
        return $query;
    }
    public function searchPhone($params=null, $options=null){
        if($options['task'] == "search-phone-order"){
            if(isset($params['search'])){
                $query=$this::where('buyer','LIKE', "%{$params['search']}%");
                $result=$query->get()->toArray();
            }         
        }
        return $result;
    }
    // public function scopeOfUser($query)
    // {
    //     if (\Session::has('user')){
    //         $user = \Session::get('user');
    //         if($user['is_admin']==1){
    //             return  $query;
    //         }else{
    //             return  $query->where('user_sell',$user->user_id);
    //         }
            
    //     }
    //     return $query;
    // }

    public function listItems($params = null, $options = null)
    {
        $result = null;
        if($options['task'] == "list-order-flow-status"){
            $query = $this::select('id','code_order','total','value_fee_ship','total_product','created_at','status_order','user_id'); 
            if(isset($params['phone'])){
                $query=$this::where('buyer','LIKE', "%{$params['phone']}%");
            }                           
            switch ($params['status'])
            {
                case 'chua_hoan_tat' :
                    $query = $query->whereIn('status_order',['dangXuLy','daXacNhan','dangGiaoHang','daGiaoHang']); 
                    break;
                case 'hoan_tat' :
                    $query = $query->whereIn('status_order',['hoanTat']); 
                    break;
                case 'da_huy' :
                    $query = $query->whereIn('status_order',['daHuy']); 
                    break;
                case 'tra_hang' :
                    $query = $query->whereIn('status_order',['traHang']); 
                    break;
                default:
                $query = $query;
                    break;
            }
            $result =  $query->orderBy('id', 'desc')->get();
        }
        if ($options['task'] == "user-list-items") {
            $query = $this::select('id','code_order','total','value_fee_ship','buyer','created_at','status_order','user_id','code_service')
                                ->where('id','>',1);
            if ((isset($params['filter']['status_order'])) && ($params['filter']['status_order'] != 'all')) {
                $query = $query->where('status_order',$params['filter']['status_order']);
            }
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            if(isset($params['pagination'])){
                $query=$query->orderBy('id', 'desc')
                              ->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $query=$query->orderBy('id', 'desc')->get();
            }
            
            $result =  $query;
        }
        if($options['task'] == "user-list-items-in-day"){
            $query = $this::select('id','code_order','total','created_at','status_order','user_id')
            ->where('id','>=',1)->where('created_at','LIKE', "%{$params['day']}%");
            $result =  $query->orderBy('id', 'desc')->get();
        }

        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item-frontend') {
            $result = self::select('id','code_order','total_product','total','value_fee_ship','info_product','user_id','buyer','status_order','created_at')
                            ->where('id', $params['id'])
                            ->first()->toArray();
        }
        if ($options['task'] == 'get-item-frontend-code') {
            $result = self::select('id','code_order','total','value_fee_ship','created_at','status_order','user_id','delivery_method','receive',
                            'info_product','buyer','pharmacy','total_product','delivery_service','code_service')
                            ->where('code_order', $params['code_order'])
                            ->first();
        }
        if ($options['task'] == 'get-item') {
            $result = self::select('id','code_order','total','value_fee_ship','created_at','status_order','user_id','buyer',
                            'info_product','pharmacy','total_product','delivery_service','code_service')
                            ->where('id', $params['id'])
                            ->first();

        }
        if ($options['task'] == 'get-item-for-update-product-in-store') {
            $result = self::select('id','info_product')
                            ->where('id', $params['id'])
                            ->OfUser()
                            ->first();
        }
        if ($options['task'] == 'get-item-last') {
            $result = self::select('id','code_order')->orderBy('id', 'DESC')->first()->toArray();
        }
        return $result;
    }
    public function sumColumItems($params = null, $options  = null){
        $result = null;
        if($options['task'] == 'admin-sum-money-items-group-by-total-in-user-sell') {
            $query = $this::select('id','total','created_at','status_order','user_sell')
                            ->where('id','>',1);
            if(isset($params['user_sell'])){
                $query->where('user_sell',$params['user_sell']);
            } 
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            $result = $query->get()->sum('total');
        }
        return $result;
    }
    public function countItems($params = null, $options  = null) {
        $result = null;
        if($options['task'] == 'admin-count-items-group-by-status-order') {
            $query = $this::groupBy('status_order')
                            ->select(DB::raw('status_order , COUNT(id) as count') )
                            ->where('id','>',1);
            $query = $this->search($query, $params);
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'admin-count-items-status-order') {
            $query = $this::groupBy('status_order')
                            ->select(DB::raw('status_order , COUNT(id) as count') )
                            ->where('id','>',1)->where('status_order',$params['status_order']);
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'admin-count-items-of-user-sell') {
            $query = $this::groupBy('user_sell')
                            ->select(DB::raw('user_sell , COUNT(id) as count') )
                            ->where('id','>',1)->where('user_sell',$params['user_sell']);
            if(isset($params['status_order'])){
                if($params['status_order']!='all'){
                    $query->where('status_order',$params['status_order']);
                }             
            }
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            $result = $query->get()->toArray();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'frontend-save-item'){
            DB::beginTransaction();
            try {

                //$params['invoice'] = isset($params['export_tax'])?json_encode($params['invoice']) :null;
                // if ($params['delivery_method'] == 1){ //Nhận hàng tại nhà thuốc
                //     $params['pharmacy'] = json_encode($params['pharmacy']);
                //     $params['receive'] = null;
                // }else{
                //     $params['pharmacy'] = null;
                //     $params['receive'] = json_encode($params['receive']);
                // }
                //$cart = \Session::get('cart');
                //$params['info_product'] = $cart[$params['user_sell']]['product'];
                $this->setCreatedHistory($params);
                $params['buyer'] = json_encode($params['buyer']);
                $params['info_product'] = json_encode($params['info_product']);
                $params['total'] = $params['total'];
                $params['status_order']='dangXuLy';
                $params['total_product'] = $params['total_product'];
                $paramsCode = [
                    'type' => 'order',
                    'value' => date('Ymd')
                ];
                $params['code_order'] ='DHTD' . date('Ymd') . sprintf("%05d",'123');
                self::insert($this->prepareParams($params));

                //Cập nhật khách hàng
                // $customer = CustomerShopModel::where('user_id',$params['user_id'])
                //                             ->where('user_sell',$params['user_sell'])
                //                             ->first();
                // if (empty($customer)){
                //     CustomerShopModel::insert([
                //         'user_id' => $params['user_id'],
                //         'user_sell' => $params['user_sell']
                //     ]);
                // }
                
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                return false;
            }

        }
        if ($options['task'] == 'frontend-save-code-order'){
            
            $params['code_order'] ='DHTD' . date('Ymd') . sprintf("%05d",$params['id']);
            self::where('id', $params['id'])->update($this->prepareParams($params));
         }
        if ($options['task'] == 'api-save-item'){
            DB::beginTransaction();
            try {
                $params['created_at']    = date('Y-m-d H:i:s');
                $params['created_by'] =  $params['user_id'];

                $params['buyer'] = json_encode($params['buyer']);
                $params['invoice'] = (isset($params['export_tax']) && ($params['export_tax'] == 1))?$params['invoice'] :null;
                if ($params['delivery_method'] == 1){ //Nhận hàng tại nhà thuốc
                    $params['pharmacy'] = json_encode($params['pharmacy']);
                    $params['receive'] = null;
                }else{
                    $params['pharmacy'] = null;
                    $params['receive'] = json_encode($params['receive']);
                }

                // $params['info_product'] = $cart[$params['user_sell']]['product'];
                $params['info_product'] = json_encode($params['info_product']);
                //$params['total'] = $cart[$params['user_sell']]['total'];
                //$params['total_product'] = $cart[$params['user_sell']]['total_product'];
                $paramsCode = [
                    'type' => 'order',
                    'value' => date('Ymd')
                ];
                $params['code_order'] ='DHTD' . date('Ymd') . sprintf("%05d",self::getMaxCode($paramsCode));
                self::insert($this->prepareParams($params));

                //Cập nhật khách hàng
                $customer = CustomerShopModel::where('user_id',$params['user_id'])
                                            ->where('user_sell',$params['user_sell'])
                                            ->first();
                if (empty($customer)){
                    CustomerShopModel::insert([
                        'user_id' => $params['user_id'],
                        'user_sell' => $params['user_sell']
                    ]);
                }

                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                return false;
            }
        }
        if($options['task'] == 'change-status-order') {
            $params['status_order'] = $params['status_order'];
            $params['delivery_service'] = $params['delivery_service'];
            $params['code_service'] = $params['code_service'];
            $this->setModifiedHistory($params);
            self::where('id', $params['id'])->update($this->prepareParams($params));
            // if ($params['currentValue'] == 'hoanTat'){ // Cập nhật lại số lượng đơn hàng

            // }
        }
        if ($options['task'] == 'update-item'){
            DB::beginTransaction();
            try {
                $this->setModifiedHistory($params);
                self::where('id', $params['id'])->update($this->prepareParams($params));
                $item = self::getItem(['id' => $params['id']], ['task' => 'get-item']);
                // if ($params['status_order'] == 'hoanTat'){ // Cập nhật lại số lượng đơn hàng
                //     (new ProductWarehouseModel())->saveItem(['warehouse_id'=>$params['warehouse_id'],
                //     'list_products'=>$item->info_product],
                //     ['task' => 'output-warehouse']);
                // }
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                return false;
            }
        }
    }

    public function userBuy(){
        return $this->belongsTo('App\Model\UserModel','user_id','id');
    }
    
}
