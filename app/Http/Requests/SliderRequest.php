<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class SliderRequest extends AjaxFormRequest
{
    private $table           = 'sliders';
    
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
        $condImage  = "required|image";
      
       // $condContent  =  "bail|required";
      
        if (!empty($id)) {
            $condImage = "image";
        }
        
        return  $rules =  [
            'file'           => $condImage                  
           // 'content'   => $condContent,
        ];
        
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['file'] = 'Hình ảnh';
        return $arrAttr;
    }
}
