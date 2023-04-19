<?php
namespace App\Http\Controllers\BackEnd;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class BackEndController extends Controller
{
    protected $moduleName = 'backend';
    protected $pathViewController = '';
    protected $params             = [];
    protected $model;
    protected $totalItemsPerPage = 10;
    protected $controllerName     = 'backEnd';
    protected $pageTitle          = '';
    public function __construct()
    {
        view()->share([
            'moduleName'                => $this->moduleName,
            'controllerName'            => $this->controllerName,
            'pageTitle'                 => $this->pageTitle
        ]);
    }
    public function index(Request $request)
    {
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') == $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params =  $session->get('params');
        $items              = $this->model->listItems($this->params, ['task'  => 'user-list-items']);

        if ($items->currentPage() > $items->lastPage()) {
            $lastPage = $items->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $items              = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        }
        return view($this->pathViewController .  'index', [
            'params'           => $this->params,
            'items'            => $items
        ]);
    }
    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        return view($this->pathViewController .  'form', [
            'item'        => $item
        ]);
    }
    public function delete(Request $request)
    {
        $params["id"]             = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);
        $notify = "Xóa $this->pageTitle thành công!";
        $request->session()->put('app_notify', $notify);
        return response()->json([
            'fail'         => false,
            'redirect_url' => route($this->controllerName),
            'message'      => $notify,
        ]);
    }
}
