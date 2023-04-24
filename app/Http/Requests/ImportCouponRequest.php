<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class ImportCouponRequest extends AjaxFormRequest
{
    private $table            = 'import_coupon';
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
        $condDate  = "bail|required|date_format:d/m/Y";
        $condWareHouse = "bail|required|exists:warehouses,id";
        $condProduct = "bail|required|exists:product,id";
        $condUnit = "bail|required|exists:units,id";
        $condPrice = "bail|required|numeric";
        $condQuantity = "bail|required|numeric";
        $condTotalMoney = "bail|required|numeric";
        return  [
            'date'                         => $condDate,
            'warehouse_id'                 => $condWareHouse,
            'list_products.product_id.*'   => $condProduct,
            //'list_products.unit_id.*'      => $condUnit,
            //'list_products.price_import.*' => $condPrice,
            //'list_products.quantity.*'     => $condQuantity,
            //'list_products.total_money.*'  => $condTotalMoney,
            //'total'        => $condTotalMoney,
        ];
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['date'] = 'Ngày nhập hàng';
        $arrAttr['list_products.product_id.*'] = 'Tên sản phẩm';
        $arrAttr['list_products.unit_id.*'] = 'Đơn vi';
        $arrAttr['list_products.price_import.*'] = 'Giá nhập';
        $arrAttr['list_products.quantity.*'] = 'Số lượng';
        $arrAttr['list_products.total_money.*'] = 'Thành tiền';
        $arrAttr['total'] = 'Tổng tiền';
        return $arrAttr;
    }
}
