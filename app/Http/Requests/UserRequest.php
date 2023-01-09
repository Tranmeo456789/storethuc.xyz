<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class UserRequest extends AjaxFormRequest
{
    private $table           = 'users';
    
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
        $condEmail  =  "bail|required|email|unique:$this->table,email";
        $condPassword = 'bail|required|between:6,100';
        $condPasswordComfirmation ='bail|required|between:6,100|same:password';
      
        if (!empty($id)) {
            $condEmail  .= ",$id";
        }
        
        return  $rules =  [
            'name'           => $condName,                    
            'email'   => $condEmail,
            'password'    => $condPassword,
            'password_confirmation' => $condPasswordComfirmation
        ];
        
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['name'] = 'Tên người dùng';
        $arrAttr['password_confirmation'] = 'Mật khẩu mới (nhập lại)';
        return $arrAttr;
    }
}
