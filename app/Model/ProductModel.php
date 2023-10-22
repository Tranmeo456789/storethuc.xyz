<?php

namespace App\Model;
use Session;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\BackEndModel;
use App\Model\CatProductModel;
use Illuminate\Support\Str;
use DB;
class ProductModel extends BackEndModel
{
    protected $casts = [
        'tick'   => 'array'
    ];
    public function __construct()
    {
        $this->table               = 'product';
        $this->controllerName      = 'product';
        $this->folderUpload        = 'product';
        $this->crudNotAccepted     = ['_token', 'btn_save','file-del','file'];
    }
   
    // public function scopeOfUser($query)
    // {
    //     if (\Session::has('user')){
    //         $user = \Session::get('user');
    //         if($user['is_admin']==1 || $user['is_admin']==2){
    //             return  $query;
    //         }else{
    //             return  $query->where('user_id',$user->user_id);
    //         }      
    //     }
    //     return $query;
    // }
    public function listItems($params = null, $options = null)
    {
        $result = null;
       // $user = Session::get('user');
        if ($options['task'] == "user-list-items") {
            $query = $this::with('unitProduct')
                            ->select('id','name','thumbnail','price','inventory','quantity_in_stock','promotion','unit_id','describe','content','status_product','slug','cat_id','image','created_at', 'updated_at')->where('id','>=',1);
            
            if ((isset($params['filter']['status_product'])) && ($params['filter']['status_product'] != 'all')) {
                $query = $query->where('status_product',$params['filter']['status_product']);
            }
            $query->orderBy('created_at', 'desc');
            if (isset($params['pagination']['totalItemsPerPage'])){
                $result =  $query->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $result = $query->get();
            }

        }

        if ($options['task'] == "user-list-items-in-warehouse") {
            $query = $this::with('productWarehouse')
                            ->select('id','name','thumbnail','quantity_in_stock')
                            ->where('id','>',1);
            $result =  $query->orderBy('id', 'desc')
                              ->paginate($params['pagination']['totalItemsPerPage']);
        }
        if ($options['task'] == "user-list-items-in-warehouse-no-pagination") {
            $query = $this::with('productWarehouse')
                            ->select('id','name','price','thumbnail','quantity_in_stock','user_id')
                            ->where('id','>',1);
            $result =  $query->orderBy('id', 'desc')
                              ->get();
        }
        if ($options['task'] == 'user-list-all-items'){
            $result = $this::selectRaw("id as product_id")
                                    ->where('id','>',1)
                                    ->get()
                                    ->toArray();
        }
        if ($options['task'] == "frontend-list-items") {
            $query = $this::with('unitProduct')->select('id','name','thumbnail','price','inventory','quantity_in_stock','promotion','unit_id','describe','content','status_product','slug','cat_id','image','created_at', 'updated_at')
                                ->where('id','>=',1)->where('status_product','con_hang');
            if (isset($params['cat_id'])){
                $query->where('cat_id', $params['cat_id']);
                //$query->whereIn('cat_id', CatProductModel::getChild($params['cat_id']));
            }
            //$query->OfCollaboratorCode()->orderBy('id', 'desc');
            if(isset($params['limit'])){
                $result=$query->paginate($params['limit']);
            }else{
                $result =  $query->get();
            }
            
        }
        
        // if ($options['task'] == "frontend-list-items-featurer") {
        //     $type = $params['type'];
        //     $query = $this::select('id','name','type','code','cat_product_id','producer_id',
        //                             'tick','type_price','price','price_vat','coefficient',
        //                             'type_vat','packing','unit_id','sell_area','amout_max',
        //                             'inventory','inventory_min','general_info','prescribe','dosage','trademark_id',
        //                             'dosage_forms','country_id','specification','benefit',
        //                             'preserve','note','image','albumImage','albumImageHash','user_id','featurer','long','wide','high',
        //                             'mass')
        //                          //   ->whereRaw("JSON_CONTAINS(`featurer`, '\"{$params['type']}\"')");
        //                             ->whereRaw("FIND_IN_SET('\"{$params['type']}\"',REPLACE(REPLACE(`featurer`, '[',''),']',''))")->where('status_product','da_duyet');
        //     if (isset($params['cat_product_id']) && ($params['cat_product_id'] != 0)){
        //         $query->whereIn('cat_product_id', CatProductModel::getChild($params['cat_product_id']));
        //     }

        //     $query->OfCollaboratorCode();
        //     $result =  $query->orderBy('id', 'desc')
        //                      ->paginate($params['limit']);
        // }
        
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')
                        ->where('id','>',1)
                        ->orderBy('name', 'asc');
            $result = $query->pluck('name', 'id')->toArray();
        }
        if($options['task'] == "list-items-search") {
            $query = $this::with('unitProduct')->select('id','name','thumbnail','price','inventory','quantity_in_stock','promotion','unit_id','describe','content','status_product','slug','cat_id','image','created_at', 'updated_at');
            if(isset($params['keyword'])){
                $query->where('name','LIKE', "%{$params['keyword']}%");
            }
            // if(isset($params['user_sell'])){
            //     $query->where('user_id',$params['user_sell']);
            // }
            $query->orderBy('id', 'asc');
            if(isset($params['limit'])){
                $query->limit($params['limit']);
            }
            $result = $query->get();
        }
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','name','thumbnail','price','inventory','quantity_in_stock','promotion','unit_id','describe','content','status_product','slug','cat_id','image','created_at', 'updated_at')
                            ->where('id', $params['id'])
                            ->first();
        }
        if ($options['task'] == 'get-item-in-slug') {
            $result = self::select('id','name','thumbnail','price','inventory','quantity_in_stock','promotion','unit_id','describe','content','status_product','slug','cat_id','image','created_at', 'updated_at')
                            ->where('slug', $params['slug'])
                            ->first();
        }
        if ($options['task'] == 'get-item-simple') {
            $result = self::with('unitProduct')->select('id','name','unit_id','price','inventory','quantity_in_stock','promotion')
                            ->where('id', $params['id'])
                            ->first();
        }

        if ($options['task'] == 'frontend-get-item') {
            $result = self::with('unitProduct')
                            ->select('id','name','thumbnail','price','inventory','quantity_in_stock','promotion','unit_id','describe','content','status_product','slug','cat_id','image','created_at', 'updated_at')
                            ->where('id', $params['id'])
                            ->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'add-item') {

             $this->setCreatedHistory($params);
            // $params['tick'] = isset($params['tick'])?json_encode($params['tick'],JSON_NUMERIC_CHECK ): NULL;
            // $params['featurer'] = isset($params['featurer'])?json_encode($params['featurer']): NULL;
            $params['user_id'] = $params['user_id'];

            // if (isset($params['albumImage'])) {
            //     $resultFileUpload       = $this->uploadFile($params['albumImage']);
            //     $params['albumImage']   = $resultFileUpload['fileAttach'];
            //     $params['albumImageHash']     = $resultFileUpload['fileHash'];
            // }
            // $catProduct = CatProductModel::find($params['cat_id']);
            // if ($catProduct){
            //     $params['cat_id'] = $catProduct->parent_id;
            // }
            
            $id = self::insertGetId($this->prepareParams($params));
        }
        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            $item = self::getItem($params,['task'=>'get-item']);
            //$this->updateFileUpload($item,$params,'albumImage');
           // $params['tick'] = isset($params['tick'])?json_encode($params['tick'],JSON_NUMERIC_CHECK ): NULL;
           // $params['featurer'] = isset($params['featurer'])?json_encode($params['featurer']): NULL;
           // $params['sell_area'] = ($params['sell_area'] != '')? json_encode($params['sell_area'],JSON_NUMERIC_CHECK ): NULL;
            $catProduct = CatProductModel::find($params['cat_id']);
            // if ($catProduct){
            //     $params['cat_product_parent_id'] = $catProduct->parent_id;
            // }
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
        if($options['task'] == 'update-status-item-of-admin'){
            self::where('id', $params['id'])->update(['status_product' => $params['status_product']]);
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
    public function countItems($params = null, $options  = null) {

        $result = null;
        if($options['task'] == 'admin-count-items-group-by-user-id') {
            $query = $this::groupBy('user_id')
                            ->select(DB::raw('user_id , COUNT(id) as count'))
                            ->where('id','>',1)->where('user_id',$params['user_id']);
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'admin-count-items-group-by-status-product') {
            $query = $this::groupBy('status_product')
                            ->select(DB::raw('status_product , COUNT(id) as count') )
                            ->where('id','>=',1);
            
            $result = $query->get()->toArray();
        }
        if ($options['task'] == "count-number-product-in-cat") {
            $query = $this::select('id','name')
                            ->where('status_product','con_hang')
                            ->where('cat_id',$params['cat_id']);
                            //->whereIn('cat_product_id', CatProductModel::getChild($params['cat_product_id']))->get();

            $result =  count($query);
        }
        return $result;
    }
    public function unitProduct(){
        return $this->belongsTo('App\Model\UnitModel','unit_id','id');
    }
    public function catProduct(){
        return $this->belongsTo('App\Model\CatProductModel','cat_id','id');
    }
    public function productWarehouse()
    {
        return $this->hasMany(ProductWarehouseModel::class,'product_id','id');
    }
}
