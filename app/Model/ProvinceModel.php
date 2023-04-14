<?php

namespace App\Model;

use App\Model\BackEndModel;
use DB;

class ProvinceModel extends BackEndModel
{
    //protected $connection = 'mysql_share_data';
    public function __construct() {
        $this->table               = 'province';
        $this->folderUpload        = '' ;

    }

    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')
                        ->orderBy('name', 'asc');
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
    public function district(){
        return $this->hasMany('App\Model\DistrictModel', 'province_id', 'id');
    }
}

