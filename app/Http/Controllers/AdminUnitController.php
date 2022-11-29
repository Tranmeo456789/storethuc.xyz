<?php

namespace App\Http\Controllers;

use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class AdminUnitController extends Controller
{
    function list(){
        $units=Unit::orderBy('created_at','desc')->paginate(10);
        return view('admin.unit.index',compact('units'));       
    }
    function store(Request $request){
        if($request->input('btn_add_unit')){
            $request->validate(
                [
                    'name' => 'required|string|unique:units',
                ],
                [
                    'required'=>':attribute không được để trống',      
                    'unique' =>':attribute đã tồn tại'     
                ],
                [
                    'name'=>'Đơn vị tính',
                ]
            );            
            Unit::create(
                [                
                    'name' => $request->input('name'),     
                ]
              );
            return redirect('admin/unit/list')->with('status','Thêm đơn vị tính thành công');
        }
        
    }
    // xóa vĩnh viễn
    function forcedelete($id){
        Unit::where('id',$id)->forceDelete();
        return redirect('admin/unit/list')->with('status','Bản ghi đã xóa vĩnh viễn!');
    }
   
}
