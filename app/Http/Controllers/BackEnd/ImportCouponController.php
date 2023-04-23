<?php

namespace App\Http\Controllers\BackEnd;

use App\Model\ImportCouponModel as MainModel;
use App\Model\WarehouseModel;
use App\Model\ProductModel;
use App\Model\UnitModel;
use Illuminate\Http\Request;
use App\Http\Controllers\BackEnd\BackEndController;
use App\Http\Requests\ImportCouponRequest as MainRequest;
class ImportCouponController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'importCoupon';
        $this->pathViewController = "backend.pages.$this->controllerName.";
        $this->pageTitle          = 'Phiếu nhập hàng';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function form(Request $request)
    {
        $item = null;
        $itemsUnit = [];
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
            $unitIDs = array_column($item->list_products,'unit_id');
            $itemsUnit = (new UnitModel())->listItems(['arrID' => $unitIDs],['task' => 'admin-list-items-in-selectbox']);
        }

        $itemsWareHouse = (new WarehouseModel())->listItems(null,['task'=>'admin-list-items-in-selectbox']);
        $itemsProduct = (new ProductModel())->listItems(null,['task'=>'admin-list-items-in-selectbox']);
        return view($this->pathViewController .  'form',
            compact('item', 'itemsWareHouse','itemsProduct','itemsUnit'));
    }
    public function save(MainRequest $request)
    {
        if (!$request->ajax()) return view("errors." .  'notfound', []);
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $request->validator->errors()
            ]);
        }
        if ($request->method() == 'POST') {
            $params = $request->all();

            $task   = "add-item";
            $notify = "Thêm mới $this->pageTitle thành công!";

            if ($params['id'] != null) {
                $task   = "edit-item";
                $notify = "Cập nhật $this->pageTitle thành công!";
            }
            if ($this->model->saveItem($params, ['task' => $task])){
                $request->session()->put('app_notify', $notify);
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' =>  null,
                    'errors' => null,
                    'message' => $notify,
                    'redirect_url' => route($this->controllerName)
                ], 200);
            }else{
                return response()->json([
                    'status' => 200,
                    'success' => false,
                    'data' => null,
                    'errors' => null,
                    'message' => 'Có lỗi xảy ra, vui lòng thử lại'
                ],200);
            }

        }
    }
}
