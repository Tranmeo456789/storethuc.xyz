<?php

namespace App\Http\Controllers\BackEnd;

use App\Model\SliderModel as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BackEnd\BackEndController;
use App\Http\Requests\SliderRequest as MainRequest;

use App\Helpers\MyFunction;
use App\Model\SliderModel;
use DB;
use Session;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class SliderController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'slider';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Danh sách slider';
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
        $session->put('params.filter.status_slider', $request->has('filter_status_slider') ? $request->get('filter_status_slider') : ($session->has('params.filter.status_slider') ? $session->get('params.filter.status_slider') : 'cong_khai'));
        
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
        $itemStatusCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status']);
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
            $thumbnail="";
            $notify = "Thêm mới $this->pageTitle thành công!";
            $params['user_id']=Auth::id();
            if($params['status_slider']=='cong_khai'){
                $itemMaxLocation=$this->model->getItem(null, ['task' => 'get-item-max-location']);
                $params['location']=$itemMaxLocation['location']+1;
            }else{
                $params['location']=0;
            }
            if ($params['id'] != null) {
                $task   = "edit-item";
                $params["id"] = $request->id;
                $item = $this->model->getItem($params, ['task' => 'get-item']);
                $thumbnail=$item['image'];
                $notify = "Cập nhật $this->pageTitle thành công!";
                if($params['status_slider']=='cho_duyet'){
                    $items              = $this->model->listItems($this->params, ['task'  => 'frontend-list-items']);
                    $temp=0;
                    foreach($items as $val){
                        $temp++;
                        $this->model->saveItem(['id'=>$val['id'],'location'=>$temp], ['task' => $task]);
                    }
                }
            }
            if($request->hasFile('file')){
                $file=$request->file;
                $filename = $file->getClientOriginalName();
                $path = $file->move('public/uploads/images/slider', $file->getClientOriginalName());
                $thumbnail='uploads/images/slider/'.$filename;   
            }
            $params['image']=$thumbnail;

            $this->model->saveItem($params, ['task' => $task]);
            $request->session()->put('app_notify', $notify);
                return response()->json([
                    'fail' => false,
                    'redirect_url' => route($this->controllerName),
                    'message'      => $notify,
                ]);
            
        }
    }
    
    function up($id){
        $params["id"] = $id;
        $itemCurent = $this->model->getItem($params, ['task' => 'get-item']);
        SliderModel::where('location', $itemCurent['location']-1)->update(
            [                  
                'location'=>$itemCurent['location'],        
            ]
          );
        SliderModel::where('id', $id)->update(
            [                  
                'location'=>$itemCurent['location']-1,        
            ]
          );
          
        // return $itemCurent['location']-1;
        return redirect('backend/danh-sach-slider')->with('app_notify','Thứ tự ảnh slider thay đổi thành công');
    }

    public function getItem(Request $request){
        $params["id"] = intval($request->id);
        $item = $this->model->getItem($params, ['task' => 'get-item-simple']);
        return json_encode($item->toArray());
    }
  
}
