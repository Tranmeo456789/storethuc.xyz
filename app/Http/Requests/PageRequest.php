<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class PageRequest extends AjaxFormRequest
{
    private $table           = 'page';
    
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
        $condName  = "bail|required|between:1,255|unique:$this->table,name";
      
        $condContent  =  "bail|required";
      
        if (!empty($id)) {
            $condName  .= ",$id";
        }
        
        return  $rules =  [
            'name'           => $condName,                    
            'content'   => $condContent,
        ];
        
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['name'] = 'Tên trang';
        return $arrAttr;
    }
}
