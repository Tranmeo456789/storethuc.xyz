<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\BackEndModel;
class ColorModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'color';
        $this->controllerName      = 'color';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save','color_select'];
    }

    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "user-list-items") {
            $query = $this::select('id', 'name','code','user_id', 'created_at', 'updated_at');

            $result =  $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);

        }
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name','code','user_id', 'created_at', 'updated_at');
            $result = $query->orderBy('name', 'asc')
                            ->pluck('name','code', 'id')->toArray();
        }
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $result = self::select('id', 'name','code','user_id', 'created_at', 'updated_at')
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
}
