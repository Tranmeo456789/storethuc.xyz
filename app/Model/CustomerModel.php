<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Model\Shop\Tinhthanhpho;
use App\Model\Shop\Quanhuyen;
use App\Model\Shop\Xaphuongthitran;
use DB;
class CustomerModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'customers';
        $this->controllerName      = 'customer';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }

    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "user-list-items") {
            $query = $this::select('id','name','code_customer','email','phone','gender','password','address_detail','address','user_id','sale_area','tax_code','legal_representative','customer_group', 'created_at', 'updated_at');
            $result =  $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);

        }
        if($options['task'] == "list-items-in-user-sell") {
            $query = DB::table('customer_shop')->select('id','user_id','user_sell');
            if($params['user_sell']){
                $query->where('user_sell',$params['user_sell']);
            }
            $result =  $query->get();
        } 
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $result = self::select('id','name','code_customer','email','phone','gender','password','address_detail','address','user_id','sale_area','tax_code','legal_representative','customer_group')
                            ->where('id', $params['id'])->first();
        }
        if($options['task'] == 'get-item-userId') {
            $result = self::select('id','name','code_customer','email','phone','gender','password','address_detail','address','user_id','sale_area','tax_code','legal_representative','customer_group')
                            ->where('user_id', $params['user_id'])->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null) {
        if($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            $wards=(new WardModel)->getItem(['id'=>(int)$params['wards']],['task' => 'get-item-full']);    
            $ward=$wards->name; 
            $district=$wards->district->name;
            $local1=$wards->district->province->name;
           $local=$ward.','.$district.','.$local1;
            self::insert([
                'name' => $params['name'],
               'code_customer' => $params['code_customer'],
                'email' => $params['email'],
                'phone' => $params['phone'],
                'customer_group'=>$params['customer_group'],
                'gender' => $params['gender'],
                'password' => md5($params['password']),
                'address_detail' => $params['address_detail'],
                'address' => $local, 
                //'sale_area' => $params['sale_area'], 
                //'tax_code' => $params['tax_code'],
                //'legal_representative' => $params['legal_representative'],                 
            ]);
        }
        if($options['task'] == 'save-item-order') {
            $params['created_at']    = date('Y-m-d H:i:s');
            self::insert($params);
        }
        if($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
        if($options['task'] == 'edit-item-order') {
            $params['updated_at']    = date('Y-m-d H:i:s');
            self::where('user_id', $params['user_id'])->update($params);
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
}
