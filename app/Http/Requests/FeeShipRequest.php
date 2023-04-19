<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class FeeShipRequest extends AjaxFormRequest
{
    private $table            = 'fee_ship';
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
        $condFeeShip  = "bail|required|numeric";
        $condProvinceId = ($id != 1) ? "bail|required": "";
        //$condDistrictId = "bail|required";
        //$condWardId="bail|required";
        return  [
            'province_id' => $condProvinceId,
            'fee_ship'        => $condFeeShip,
            //'district_id' => $condDistrictId,
            // 'ward_id'=>$condWardId
        ];
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['fee_ship'] = 'Phí ship';
        return $arrAttr;
    }
}
