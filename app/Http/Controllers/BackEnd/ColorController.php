<?php

namespace App\Http\Controllers\BackEnd;

use App\Model\ColorModel as MainModel;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\BackEnd\BackEndController;
use App\Http\Requests\ColorRequest as MainRequest;
class ColorController extends BackEndController
{

    public function __construct()
    {
        $this->controllerName     = 'color';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Quản lý màu';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function save(MainRequest $request)
    {
        if (!Request::ajax()) return view("errors." .  'notfound', []);
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
}
