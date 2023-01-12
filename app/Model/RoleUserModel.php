<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\BackEndModel;
class RoleUserModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'role_user';
        $this->controllerName      = '';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }

    public function saveItem($params = null, $options = null) {

        if($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            self::insert($this->prepareParams($params));
        }

        if($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            self::where('user_id', $params['user_id'])->update($this->prepareParams($params));
        }
    }
   
}
