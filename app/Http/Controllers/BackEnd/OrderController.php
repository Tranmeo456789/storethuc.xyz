<?php

namespace App\Http\Controllers\BackEnd;
use Illuminate\Http\Request;
use App\Model\ProductModel;
use App\Model\UsersModel;
use App\Http\Requests;
use App\Http\Controllers\BackEnd\BackEndController;
use App\Model\OrderModel as MainModel;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class OrderController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'order';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Danh sách đơn hàng';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function index(Request $request)
    {
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.filter.status_order', $request->has('filter_status_order') ? $request->get('filter_status_order') : ($session->has('params.filter.status_order') ? $session->get('params.filter.status_order') : 'all'));

        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params     = $session->get('params');

        $items            = $this->model->listItems($this->params, ['task'  => 'user-list-items']);

        if ($items->currentPage() > $items->lastPage()) {
            $lastPage = $items->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $items              = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        }
        $itemStatusOrderCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status-order']);
        return view($this->pathViewController .  'index', [
            'params'           => $this->params,
            'items'            => $items,
            'itemStatusOrderCount' => $itemStatusOrderCount
        ]);
    }
    public function detail(Request $request)
    {
        $params['id']= intval($request->id);
        $id=intval($request->id);
        $item= $this->model->getItem($params,['task' => 'get-item']);
        //return($item['buyer']['fullname']);
        $pageTitle ='Chi tiết đơn hàng';
        //$itemsWarehouse = (new WarehouseModel())->listItems(['user_id'=>$item['user_sell']],['task' => 'admin-list-items-in-selectbox']);
        $params['group_id'] = array_keys($item['info_product']);
        $itemsProduct = (new ProductModel())->listItems($params,['task' => 'user-list-items']);
        
        return view($this->pathViewController .  'detail',
                 compact('id','item','itemsProduct','pageTitle'));
    }
    public function save(Request $request)
    {
        // if (!$request->ajax()) return view("errors." .  'notfound', []);
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $request->validator->errors()
            ]);
        }
        if ($request->method() == 'POST') {
            $params['id'] = intval($request->id);
            $params['status_order'] = $request->status_order;
            //$params['warehouse_id'] = intval($request->warehouse_id);
            $task   = "update-item";
            $notify = "Cập nhật $this->pageTitle thành công!";
            $this->model->saveItem($params, ['task' => $task]);
            $request->session()->put('app_notify', $notify);
            return response()->json([
                'fail' => false,
                'redirect_url' => route($this->controllerName),
                'message'      => $notify,
            ]);
        }
    }
    public function changeStatusOrder(Request $request)
    {
        $params["status_order"]  = $request->status_order;
        $params['delivery_service']=$request->delivery_service;
        $params['code_service'] =$request->code_service;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-status-order']);
        $notify = "Cập nhật thông tin đơn hàng thành công!";
        $request->session()->put('app_notify', $notify);
       // return redirect()->route($this->controllerName);
         return response()->json([
             'fail'         => false,
             'redirect_url' => route('backend.order.detail',['id'=>$request->id]),
             'message'      => $notify
         ]);
    }
}
