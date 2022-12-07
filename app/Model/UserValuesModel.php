<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;
use Hash;
use App\Helpers\Format;

class UserValuesModel extends BackEndModel
{
    protected $connection = 'mysql_share_data';
    public function __construct() {
        $this->table               = 'user_values';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','isnumber','password_confirmation','password_old','submit','btn-register'];
    }
}
