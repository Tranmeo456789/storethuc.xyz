<?php

namespace App\Model;

use App\Model\BackEndModel;
use DB;
use Hash;
use App\Helpers\Format;

class UsersModel extends BackEndModel
{
   // protected $connection = 'mysql_share_data';
    protected $hidden = [
        'password'
    ];
    public function __construct() {
        $this->controllerName      = 'user';
        $this->table               = 'users';
        $this->folderUpload        = '' ;
        $filedSearch               = array_key_exists($this->controllerName, config('myconfig.config.search')) ? $this->controllerName : 'default';
        $this->fieldSearchAccepted = array_diff(config('myconfig.config.search.' . $filedSearch),['all']);
        $this->crudNotAccepted     = ['_token','isnumber','password_confirmation','password_old','submit','btn-register','details','task','id'];
    }
    public function getItem($params = null, $options = null) {
        $result = null;

        if($options['task'] == 'get-item') {
            $result = self::where('user_id', $params['user_id'])->first();
        }
        if($options['task'] == 'user-login') {
            if (isset($params['email'])){
                $result = self::where('email', $params['email'])->first();
            }else{
                $result = self::where('phone', $params['phone'])->first();
            }
            if ($result) {
                if (Hash::check($params['password'],$result['password'])){
                    return $result;
                }else{
                    return null;
                }
            }
        }
        return $result;
    }
    public function saveItem($params = null, $options = null) {

        if($options['task'] == 'register') {
            $params['password']  = Hash::make($params['password']);
            if (!isset($params['user_type_id']) || $params['user_type_id'] == ''){
                $params['user_type_id'] = 1;
            }
           $params['user_id'] = $this->insertGetId($this->prepareParams($params));

            if (is_numeric($params['user_id'])){
                $paramsCode = [
                    'type' => 'user_type_id',
                    'value' => $params[ 'user_type_id']
                ];
                $member_id = self::getMaxCode($paramsCode);
                $paramsUserValue =[
                    'user_id' =>$params['user_id'],
                    'user_field' =>'member_id',
                    'value' =>$member_id
                ];
                \App\Model\Shop\UserValuesModel::insert($this->prepareParams($paramsUserValue));
                return self::getItem(['user_id'=>$params['user_id']],['task' => 'get-item']);
            }
            return false;
        }
        if($options['task'] == 'add-item-editor') {
            $params['password']  = Hash::make($params['password']);
            $params['user_type_id'] = 0;
            $params['is_admin'] = 2;
           $params['user_id'] = $this->insertGetId($this->prepareParams($params));

            if (is_numeric($params['user_id'])){
                $paramsCode = [
                    'type' => 'user_type_id',
                    'value' => $params[ 'user_type_id']
                ];
                $member_id = self::getMaxCode($paramsCode);
                $paramsUserValue =[
                    'user_id' =>$params['user_id'],
                    'user_field' =>'member_id',
                    'value' =>$member_id
                ];
                \App\Model\Shop\UserValuesModel::insert($this->prepareParams($paramsUserValue));
                //return self::getItem(['user_id'=>$params['user_id']],['task' => 'get-item']);
            }
            //return false;
        }
        if($options['task'] == 'update-item'){
            $details = $params['details'];
            $params['province_id'] =$details['province_id'];
            DB::beginTransaction();
            try {
                $details = $params['details'];
                if (isset($details['sell_area'])){
                    $details['sell_area'] = ($details['sell_area'] != '')? json_encode($details['sell_area'],JSON_NUMERIC_CHECK ): NULL;;
                }
                $params['province_id'] = $details['province_id'];
                $user = self::where('user_id', $params['user_id'])->first();
                self::where('user_id', $params['user_id'])->update($this->prepareParams($params));
                $paramsUserValue =[];
                \App\Model\Shop\UserValuesModel::where('user_id', $params['user_id'])->delete();
                foreach ($details as $key => $value){
                    $paramsUserValue =[
                        'user_id' =>$params['user_id'],
                        'user_field' =>$key,
                        'value' =>$value
                    ];
                    \App\Model\Shop\UserValuesModel::insert($this->prepareParams($paramsUserValue));
                }
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                return false;
                throw $th;
            }
        }
        if($options['task'] == 'edit-item-editor'){
            DB::beginTransaction();
            try {
                $user = self::where('user_id', $params['user_id'])->first();
                $params['password']  = Hash::make($params['password']);
                self::where('user_id', $params['user_id'])->update($this->prepareParams($params));
                $paramsUserValue =[];
                \App\Model\Shop\UserValuesModel::where('user_id', $params['user_id'])->delete();
                    $paramsUserValue =[
                        'user_id' =>$params['user_id'],
                    ];
                    \App\Model\Shop\UserValuesModel::insert($this->prepareParams($paramsUserValue));
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                return false;
                throw $th;
            }
        }
        if($options['task'] == 'change-password') {
            DB::beginTransaction();
            try {
                $password       = Hash::make($params['password']);
                self::where('user_id', $params['user_id'])->update(['password' => $password]);
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                DB::rollback();
                return false;
                throw $th;
            }

        }
    }
    public function details()
    {
        return $this->hasMany(\App\Model\Shop\UserValuesModel::class,'user_id','user_id')
                    ->select('user_id','user_field','value');
    }
    public function listItems($params = null, $options = null)
    {
        $result = null;
        if($options['task'] == "list-store-select-province") {
            $result =  self::where([
                ['user_type_id', $params['user_type_id']],
                ['province_id', $params['province_id']]
            ])->get();
        }
        if($options['task'] == "list-store-select-district") {
            $result =  self::where([
                ['user_type_id', $params['user_type_id']],
                ['district_id', $params['district_id']]
            ])->get();
        }
        if($options['task'] == "list-store-select-of-shop") {
            $result =  self::where([
                ['user_type_id',">=",$params['user_type_id']],
                ['domain_register',"shop.tdoctor.vn"]
            ])->get();
        }
        if($options['task'] == "admin-list-items-of-shop") {
            $query = $this::select('user_id','email','fullname','phone','user_type_id','gender','is_admin','created_at')
                         ->where('domain_register',"shop.tdoctor.vn");
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            if(isset($params['user_type_id'])){
                $query->where('user_type_id','>',$params['user_type_id']);
            }
            if (isset($params['search']['value']) && ($params['search']['value'] !== ""))  {
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
            $query->orderBy('created_at', 'desc');
            if (isset($params['pagination']['totalItemsPerPage'])){
                $result =  $query->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $result = $query->get();
            }
        }
        if($options['task'] == "list-item-user-type-id-up3-of-shop") {
            $query = $this::select('user_id','email','fullname','phone','user_type_id','gender')
            ->where('domain_register',"shop.tdoctor.vn")->where('user_type_id','>',3);
            $result = $query->get();
        }
        if($options['task'] == "admin-list-editor-of-shop") {
            $query = $this::select('user_id','email','fullname','phone','user_type_id','gender','is_admin','created_at');
            if(isset($params['is_editor'])){
                $query->where('is_admin',$params['is_editor']);
            }
            if (isset($params['search']['value']) && ($params['search']['value'] !== ""))  {
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
            $query->orderBy('created_at', 'desc');
            if (isset($params['pagination']['totalItemsPerPage'])){
                $result =  $query->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $result = $query->get();
            }
        }
        return $result;
    }
    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            self::where('user_id', $params['user_id'])->delete();
        }
    }
}
