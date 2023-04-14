<?php

namespace App\Model;

use App\Model\BackEndModel;
use DB;

class DistrictModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'district';
    }

    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')
                        ->orderBy('name', 'asc');
            if (isset($params['parentID'])){
                $query->where('province_id', $params['parentID']);
            }
            $result = $query->pluck('name', 'id')->toArray();
        }

        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item-full') {
            $result = self::where('id', $params['id'])->first();
        }
        return $result;
    }
    public function province(){
        return $this->belongsTo('App\Model\ProvinceModel','province_id','id');
    }
    public function ward(){
        return $this->hasMany('App\Model\WardModel', 'district_id', 'id');
    }
}

