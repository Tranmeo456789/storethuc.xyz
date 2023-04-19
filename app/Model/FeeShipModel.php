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
        if($options['task'] == 'get-item') {
            $result = self::select('id', 'province_id','district_id','ward_id','fee_ship','created_at','updated_at')
                            ->where('id', $params['id'])->first();
        }
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
