<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class ProductRequest extends AjaxFormRequest
{
    private $table           = 'product';
    private $tableCatProduct = 'cat_product';
    private $tableUnit = 'units';
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
       // $condImage  =  "bail|required";
        //$condCatPrduct  = "";
        //$condCatPrduct  =  "bail|required|exists:$this->tableCatProduct,id";
        $condPrice  =  "bail|required|numeric";
       // $condInventory ="bail|required|numeric";
        $condPromotion="bail|numeric";
        $condContent  =  "bail|required";
        $condDescribe =  "bail|required";
        $condUnit  =  "bail|required|exists:$this->tableUnit,id";
        if (!empty($id)) { // edit
            $condName  .= ",$id";
        }
        // $rulesAlbumImage = array();
        // $condAlbumImage = "image";
        // if ((!empty($this->albumImage)) && count($this->albumImage) > 0) {
        //     $albumImage = $this->albumImage;
        //     foreach ($albumImage as $key => $file) {
        //         $rulesAlbumImage['albumImage.'.$key] = $condAlbumImage;
        //     }
        // }

        return  $rules =  [
            'name'           => $condName,           
            //'image'          => $condImage,          
            //'cat_id' => $condCatPrduct,         
            'price'          => $condPrice,
            'promotion'=>$condPromotion,
            //'inventory' => $condInventory,
            'unit_id'        => $condUnit,
            'content'   => $condContent,
            'describe'        => $condDescribe,
        ];
        
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['name'] = 'Tên sản phẩm';
        return $arrAttr;
    }
}
