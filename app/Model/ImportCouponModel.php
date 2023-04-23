<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\BackEndModel;
use App\Model\WarehouseModel;
use App\Model\ProductWarehouseModel;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Helpers\MyFunction;
class ImportCouponModel extends BackEndModel
{
    protected $casts = [
        'list_products'   => 'array'
    ];
    public function __construct() {
        $this->table               = 'import_coupon';
        $this->controllerName      = 'importCoupon';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }
    // public function scopeOfUser($query)
    // {
    //     if (\Session::has('user')){
    //         $user = \Session::get('user');
    //         return  $query->where('user_id',$user->user_id);
    //     }
    //     return $query;
    // }
    public function scopeOfActive($query)
    {
        return  $query->whereNull('deleted_by');
    }
    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "user-list-items") {
            $query = $this::select('id', 'name', 'date','warehouse_id','list_products','total',
                                    'created_at', 'updated_at')
                                    ->where('id','>',1);
            $result =  $query->ofActive()
                            ->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);

        }
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'date','warehouse_id','list_products','total')
                            ->where('id','>',1)
                            ->ofActive()
                            ->where('id', $params['id'])->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null) {
        if($options['task'] == 'add-item') {
            DB::beginTransaction();
            try {
                $this->setCreatedHistory($params);
                $list_products = $params['list_products'];
                if (count($list_products['product_id']) > 0){
                    $arrProduct = [];
                    foreach($list_products['product_id'] as $key=>$val){
                        $arrProduct[$list_products['product_id'][$key]] = [
                            'product_id' => $list_products['product_id'][$key],
                            'unit_id' => $list_products['unit_id'][$key],
                            'quantity' => str_replace('.','',$list_products['quantity'][$key]),
                            'price_import' => str_replace('.','',$list_products['price_import'][$key]),
                            'total_money' => str_replace('.','',$list_products['total_money'][$key])
                        ];
                    }
                    $list_products = $arrProduct;
                    $params['list_products'] = json_encode($arrProduct);
                }
                $params['date'] = MyFunction::formatDateMySQL($params['date']);
                $params['total'] = str_replace('.','',$params['total']);
                $params['user_id'] = Auth::user()->id??null;
                $paramsCode = [
                    'type' => 'import_coupon',
                    'value' => date('Ymd')
                ];
                $params['name'] = 'PNK' . date('Ymd') . sprintf("%05d",self::getMaxCode($paramsCode));

                self::insert($this->prepareParams($params));
                //Update số lượng cho kho
                (new ProductWarehouseModel())->saveItem(['warehouse_id'=>$params['warehouse_id'],
                                                            'list_products'=>$list_products],
                                                        ['task' => 'input-warehouse']);
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                return false;
            }
        }

        if($options['task'] == 'edit-item') {
            DB::beginTransaction();
            try {
                $this->setModifiedHistory($params);
                $item = self::find($params['id']);

                $list_products = $params['list_products'];
                if (count($list_products['product_id']) > 0){
                    $arrProduct = [];
                    foreach($list_products['product_id'] as $key=>$val){
                        $arrProduct[$list_products['product_id'][$key]] = [
                            'product_id' => $list_products['product_id'][$key],
                            'unit_id' => $list_products['unit_id'][$key],
                            'quantity' => str_replace('.','',$list_products['quantity'][$key]),
                            'price_import' => str_replace('.','',$list_products['price_import'][$key]),
                            'total_money' => str_replace('.','',$list_products['total_money'][$key])
                        ];
                    }
                    $list_products = $arrProduct;
                    $params['list_products'] = json_encode($arrProduct);
                }
                $params['date'] = MyFunction::formatDateMySQL($params['date']);
                $params['total'] = str_replace('.','',$params['total']);
                self::where('id', $params['id'])->update($this->prepareParams($params));
                //Update số lượng cho kho

                (new ProductWarehouseModel())->saveItem(['warehouse_id'=>$item->warehouse_id,
                                                            'list_products'=>$item->list_products],
                                                        ['task' => 'output-warehouse']);
                (new ProductWarehouseModel())->saveItem(['warehouse_id'=>$params['warehouse_id'],
                                                            'list_products'=>$list_products],
                                                        ['task' => 'input-warehouse']);
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                return false;
            }

        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
            $item = self::find($params['id']);
            $item->deleted_at   = date('Y-m-d H:i:s');
            $item->deleted_by =  Auth::user()->id??'';
            $item->save();
            (new ProductWarehouseModel())->saveItem(['warehouse_id'=>$item->warehouse_id,
                                                            'list_products'=>$item->list_products],
                                                        ['task' => 'output-warehouse']);
        }
    }
    public function warehouse(){
        return $this->belongsTo('App\Model\WarehouseModel');
    }
}
