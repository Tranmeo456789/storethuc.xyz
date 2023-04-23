<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\BackEnd\BackEndController;

use Illuminate\Http\Request;
use App\Http\Requests\WarehouseRequest as MainRequest;
use App\Model\WarehouseModel as MainModel;
use App\Model\ProductModel;
use App\Model\ProvinceModel;
use App\Model\DistrictModel;
use App\Model\WardModel;
use App\Model\UsersModel;
class WarehouseController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'warehouse';
        $this->pathViewController = "backend.pages.$this->controllerName.";
        $this->pageTitle          = 'Kho hàng';
        $this->model = new MainModel();
        parent::__construct();
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
            $this->model->saveItem($params, ['task' => $task]);
            $request->session()->put('app_notify', $notify);
            return response()->json([
                'fail' => false,
                'redirect_url' => route($this->controllerName),
                'message'      => $notify,
            ]);
        }
    }
    public function form(Request $request)
    {
        $item = null;
        $itemsProvince = (new ProvinceModel())->listItems(null,['task'=>'admin-list-items-in-selectbox']);
        $itemsDistrict = [];
        $itemsWard = [];

        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);

            $params['province_id'] = ((isset($item->province_id)
                                        && ($item->province_id != 0))
                                        ? $item->province_id:0);
            if ($params['province_id'] != 0){
                $itemsDistrict = (new DistrictModel())->listItems(['parentID' => $params['province_id']],
                                                                    ['task'=>'admin-list-items-in-selectbox']);
            }
            $params['district_id'] = ((isset($item->district_id)
                                        && ($item->district_id != 0))
                                        ? $item->district_id:0);

            if ($params['district_id']  != 0){
                $itemsWard = (new WardModel())->listItems(['parentID' => $params['district_id']],
                                                                    ['task'=>'admin-list-items-in-selectbox']);
            }
        }

        return view($this->pathViewController .  'form',
            compact('item', 'itemsProvince' ,'itemsDistrict','itemsWard'));
    }
    public function info(Request $request)
    {
        $session = $request->session();
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params =  $session->get('params');
        $pageTitle          = 'Thông tin Kho hàng';

        $itemsProduct = (new ProductModel())->listItems($this->params, ['task' => 'user-list-items-in-warehouse']);

        $itemsWarehouses = $this->model->listItems(null,['task' => 'admin-list-items-in-selectbox']);
        return view($this->pathViewController .  'info',
            compact('pageTitle','itemsProduct' ,'itemsWarehouses'));
    }
    
}
