<?php

namespace App\Http\Controllers\BackEnd;

use App\Model\PageModel as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BackEnd\BackEndController;
use App\Http\Requests\PageRequest as MainRequest;

use App\Helpers\MyFunction;

use DB;
use Session;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class PageController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'page';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Danh sách trang';
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
        $session->put('params.filter.status_page', $request->has('filter_status_page') ? $request->get('filter_status_page') : ($session->has('params.filter.status_page') ? $session->get('params.filter.status_page') : 'cong_khai'));
        
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
        $itemStatusPageCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status-page']);
        //return($items);
        $pathView = $request->ajax() ? 'ajax' : 'index';
        return view($this->pathViewController .  $pathView, [
            'params'           => $this->params,
            'items'            => $items,
            'itemStatusPageCount' => $itemStatusPageCount
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
            if ($params['id'] != null) {
                $task   = "edit-item";
                $params["id"] = $request->id;
                $item = $this->model->getItem($params, ['task' => 'get-item']);
                $notify = "Cập nhật $this->pageTitle thành công!";
            }
            $params['slug']=Str::slug($request->input('name'));
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
   public function changepageInAdmin(Request $request,$id,$status){
        $params['id']=$request->id;
        $params['status_page']=$request->status;
        $this->model->saveItem($params, ['task' => 'update-status-item-of-admin']);
        $request->session()->put('app_notify', 'Thay đổi trạng thái thuốc thành công!');
        return back()->withInput();
   }
}
