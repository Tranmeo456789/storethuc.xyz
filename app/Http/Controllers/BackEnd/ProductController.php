<?php

namespace App\Http\Controllers\BackEnd;

use App\Model\ProductModel as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BackEnd\BackEndController;
use App\Model\CatProductModel;
use App\Http\Requests\ProductRequest as MainRequest;
use App\Model\UnitModel;
use App\Helpers\MyFunction;
use DB;
use Session;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class ProductController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'product';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Danh sách sản phẩm';
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
        $session->put('params.filter.status_product', $request->has('filter_status_product') ? $request->get('filter_status_product') : ($session->has('params.filter.status_product') ? $session->get('params.filter.status_product') : 'con_hang'));
        
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
        $itemStatusProductCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status-product']);
      // return($itemStatusProductCount);
        $pathView = $request->ajax() ? 'ajax' : 'index';
        return view($this->pathViewController .  $pathView, [
            'params'           => $this->params,
            'items'            => $items,
            'itemStatusProductCount' => $itemStatusProductCount
         ]);     
    }
    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        $itemsCatProduct = (new CatProductModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        
        $itemsUnit = (new UnitModel())->listItems(null, ['task' => 'admin-list-items-in-selectbox']);
        return view($this->pathViewController . 'form', compact(
            'item',
            'itemsCatProduct',
            'itemsUnit',
        ));
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
            $thumbnail="";
            $notify = "Thêm mới $this->pageTitle thành công!";
            $params['user_id']=Auth::id();
            $params['inventory']=0;
            if ($params['id'] != null) {
                $task   = "edit-item";
                $params["id"] = $request->id;
                $item = $this->model->getItem($params, ['task' => 'get-item']);
                $thumbnail=$item['thumbnail'];
                $notify = "Cập nhật $this->pageTitle thành công!";
            }
            if($request->hasFile('file')){
                $file=$request->file;
                $filename = $file->getClientOriginalName();
                $path = $file->move('public/uploads/images/product', $file->getClientOriginalName());
                $thumbnail='uploads/images/product/'.$filename;   
            }
            $params['thumbnail']=$thumbnail;
            $params['slug']=Str::slug($request->input('name')).'.html';
            $this->model->saveItem($params, ['task' => $task]);
            $request->session()->put('app_notify', $notify);
                return response()->json([
                    'fail' => false,
                    'redirect_url' => route($this->controllerName),
                    'message'      => $notify,
                ]);
            
        }
    }
    
    public function getItem(Request $request){
        $params["id"] = intval($request->id);
        $item = $this->model->getItem($params, ['task' => 'get-item-simple']);
        return json_encode($item->toArray());
    }
   
}
