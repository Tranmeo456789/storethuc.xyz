<?php

namespace App\Http\Controllers\BackEnd;

use App\Model\UsersModel as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BackEnd\BackEndController;
use App\Http\Requests\UserRequest as MainRequest;

use App\Helpers\MyFunction;

use DB;
use Session;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class UserController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'user';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Danh sách người dùng';
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
        $session->put('params.filter.status_user', $request->has('filter_status_user') ? $request->get('filter_status_user') : ($session->has('params.filter.status_user') ? $session->get('params.filter.status_user') : 'kich_hoat'));
        
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
        $itemStatusCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status-page']);
        //return($items);
        $pathView = $request->ajax() ? 'ajax' : 'index';
        return view($this->pathViewController .  $pathView, [
            'params'           => $this->params,
            'items'            => $items,
            'itemStatusCount' => $itemStatusCount
         ]);     
    }
    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
      
        return view($this->pathViewController . 'form', compact(
            'item',
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
            $notify = "Thêm mới $this->pageTitle thành công!";
            $params['user_id']=Auth::id();
            $params['password'] = Hash::make($params['password']);
            if ($params['id'] != null) {
                $task   = "edit-item";
                $params["id"] = $request->id;
                $item = $this->model->getItem($params, ['task' => 'get-item']);
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
    
    public function getItem(Request $request){
        $params["id"] = intval($request->id);
        $item = $this->model->getItem($params, ['task' => 'get-item-simple']);
        return json_encode($item->toArray());
    }
  
}
