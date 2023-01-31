<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class SettingRequest extends AjaxFormRequest
{
    private $table           = 'infomation';
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->id;
        $condName  = "bail|required|between:1,255";
        $condPhone  = "required|numeric";
        $condAddress = "required";
        
        return  $rules =  [
            'name'           => $condName, 
            'phone'          => $condPhone,
            'address'          => $condAddress
        ];
        
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['name'] = 'Tên theme';
        $arrAttr['phone'] = 'Số điện thoại';
        $arrAttr['address'] = 'Địa chỉ';
        return $arrAttr;
    }
}
