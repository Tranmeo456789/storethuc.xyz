<?php

namespace App\Model;

use App\Model\BackEndModel;
use DB;

class WardModel extends BackEndModel
{
    //protected $connection = 'mysql_share_data';
    public function __construct() {
        $this->table               = 'ward';
    }

    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')
                        ->orderBy('name', 'asc');
            if (isset($params['parentID'])){
                $query->where('district_id', $params['parentID']);
            }
            $result = $query->pluck('name', 'id')->toArray();
        }
        if($options['task'] == "list-items-in-selectbox-api") {
            $query = $this->select('id', 'name')
                        ->orderBy('name', 'asc');
            if (isset($params['parentID'])){
                $query->where('district_id', $params['parentID']);
            }
            $result = $query->get()->toArray();
        }
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item-full') {
            $result = self::with(['district','district.province'])
                            ->select('id', 'name','district_id')
                            ->where('id', $params['id'])->first();
        }
        return $result;
    }
    public function district(){
        return $this->belongsTo('App\Model\DistrictModel','district_id');
    }
}

