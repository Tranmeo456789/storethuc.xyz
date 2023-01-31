<?php

namespace App\Model;
use Session;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\BackEndModel;
use Illuminate\Support\Str;
use DB;
class SettingModel extends BackEndModel
{
   // protected $casts = [];
    public function __construct()
    {
        $this->table               = 'infomation';
        $this->controllerName      = 'setting';
        $this->folderUpload        = '';
        $this->crudNotAccepted     = ['_token', 'btn_save','file-del'];
    }
   
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','name','phone','address','color_bg_header','color_bg_body','user_id','created_at', 'updated_at')
                            ->where('id', $params['id'])
                            ->first();
        }
        if ($options['task'] == 'frontend-get-item') {
            $result = self::select('id','name','phone','address','color_bg_header','color_bg_body','user_id','created_at', 'updated_at')
                            ->where('id', $params['id'])
                            ->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);         
            self::where('id',1)->update($this->prepareParams($params));
        }
    }
   
}
