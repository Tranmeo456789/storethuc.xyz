<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\BackEndModel;

class CustomerShopModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'customer_shop';
        $this->controllerName      = '';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }


}
