<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class WarehouseRequest extends AjaxFormRequest
{
    private $table            = 'warehouses';
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
        $condProvince = "bail|required";
        $condDistrict  = "bail|required";
        $condWards  = "bail|required";
        if(!empty($id)){ // edit
            $condName  .= ",$id";
        }
        return  [
            'name'        => $condName,
            'province_id' => $condProvince,
            'district_id' => $condDistrict,
            'ward_id'     => $condWards,
        ];
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['name'] = 'Tên kho hàng';
        return $arrAttr;
    }
}
