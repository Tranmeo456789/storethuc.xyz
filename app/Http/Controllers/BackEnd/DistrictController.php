<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\BackEnd\BackEndController;
use Illuminate\Http\Request;
use App\Model\DistrictModel as MainModel;
class DistrictController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'district';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Quận huyện';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function getListByParentID(Request $request){
        if (!$request->ajax()) return view("errors." .  '404', []);
        $params["parentID"]   = intval($request->parentID);
        echo json_encode($this->model->listItems($params,['task'=>'admin-list-items-in-selectbox']));
    }

}
