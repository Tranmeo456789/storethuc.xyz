<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\BackEnd\BackEndController;
use Illuminate\Http\Request;
use App\Model\WardModel as MainModel;
class WardController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'ward';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Xã, phường, thị trấn';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function getListByParentID(Request $request){
        if (!$request->ajax()) return view("errors." .  '404', []);
        $params["parentID"]   = intval($request->parentID);
        echo json_encode($this->model->listItems($params,['task'=>'admin-list-items-in-selectbox']));
    }

}
