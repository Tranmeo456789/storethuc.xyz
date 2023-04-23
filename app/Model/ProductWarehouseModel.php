<?php

namespace App\Model;
use Session;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\BackEndModel;
use App\Model\ProductModel;
use Illuminate\Support\Str;
class ProductWarehouseModel extends BackEndModel
{

    public function __construct()
    {
        $this->table               = 'product_warehouse';
        $this->controllerName      = '';
        $this->folderUpload        = '';
        $this->crudNotAccepted     = [];
    }

    public function saveItem($params = null, $options = null)
    {
        if($options['task'] == 'input-warehouse') {
            $arrProductID = array_column($params['list_products'],'product_id');
            $item = self::where('warehouse_id',$params['warehouse_id'])
                        ->whereIn('product_id',$arrProductID)
                        ->get()->toArray();

            $listProducts = $params['list_products'];
            foreach($item as $key => $val) {
                if (isset($listProducts[$val['product_id']])){
                    self::where('warehouse_id',$params['warehouse_id'])
                        ->where('product_id',$val['product_id'])
                        ->update([
                            'quantity' => $val['quantity'] + $listProducts[$val['product_id']]['quantity']
                        ]);

                    //Update số lượng sản phẩm còn lại cho tất cả các kho
                    $product = ProductModel::find($val['product_id']);
                    $product->quantity_in_stock +=  $listProducts[$val['product_id']]['quantity'];
                    $product->save();
                }
            }
        }

        if ($options['task'] == 'output-warehouse') {
            $arrProductID = array_column($params['list_products'],'product_id');
            $items = self::where('warehouse_id',$params['warehouse_id'])
                        ->whereIn('product_id',$arrProductID)
                        ->get()->toArray();
            $listProducts = $params['list_products'];
            foreach($items as $key => $val) {
                if (isset($listProducts[$val['product_id']])){
                    self::where('warehouse_id',$params['warehouse_id'])
                        ->where('product_id',$val['product_id'])
                        ->update([
                            'quantity' => $val['quantity'] - $listProducts[$val['product_id']]['quantity']
                        ]);

                    //Update số lượng sản phẩm còn lại cho tất cả các kho
                    $product = ProductModel::find($val['product_id']);
                    $product->quantity_in_stock -=  $listProducts[$val['product_id']]['quantity'];
                    $product->save();
                }
            }
        }
    }


}
