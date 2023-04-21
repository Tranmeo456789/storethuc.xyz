<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\BackEndModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeeShipModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'fee_ship';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }

    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "user-list-items") {
            $query = $this::select('id', 'province_id','district_id','ward_id','fee_ship','created_at','updated_at');

            $result =  $query->paginate($params['pagination']['totalItemsPerPage']);

        }
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name');
            // if (isset($params['arrID'])){
            //     $query->whereIn('id', $params['arrID']);
            // }
            $result = $query->orderBy('name', 'asc')
                            ->pluck('name', 'id')->toArray();
        }
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        $query = $this->select('id', 'province_id','district_id','ward_id','fee_ship','created_at','updated_at');
        if($options['task'] == 'get-item') {
            $query = $query->where('id', $params['id']);
        }
        if($options['task'] == 'get-item-follow-address') {
            if(isset($params['province_id']) && $params['province_id'] != null){
                $query = $query->where('province_id', $params['province_id']);
            }
            if(isset($params['district_id']) && $params['district_id'] != null){
                $query = $query->where('district_id', $params['district_id']);
            }
            if(isset($params['ward_id']) && $params['ward_id'] != null){
                $query = $query->where('ward_id', $params['ward_id']);
            }
        }
        $result = $query->first();
        return $result;
    }
    public function saveItem($params = null, $options = null) {

        if($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            self::insert($this->prepareParams($params));
        }

        if($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
    public function province(){
        return $this->belongsTo('App\Model\ProvinceModel','province_id','id');
    }
    public function district(){
        return $this->belongsTo('App\Model\DistrictModel','district_id','id');
    }
    public function ward(){
        return $this->belongsTo('App\Model\WardModel','ward_id','id');
    }
}
