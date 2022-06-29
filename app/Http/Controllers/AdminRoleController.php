<?php

namespace App\Http\Controllers;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRoleController extends Controller
{
    function __construct()
    {

        $this->middleware(function($request, $next){
            session(['module_active'=>'role']);
            return $next($request);
        });
    }
    function list(){
        $roles=Role::paginate(10);
        return view('admin.role.list',compact('roles'));
    }
    function add(){
        $permissionParrent=Permission::where('parrent_id','0')->get();
        return view('admin.role.add',compact('permissionParrent'));
    }
    function store(Request $request){
        $request->validate(
            [
            'name' => 'required|string|unique:roles',
            'desc_role' => 'required|string',
            ],
            [
                'unique'=>':attribute đã tồn tại',
                'required'=>':attribute không được để trống',
            ],
            [
                'name'=>'Tên nhóm quyền',
                'desc_role'=>'Mô tả nhóm quyền'
            ]
        );
        
        $role=Role::create(
            [                
                'name'=>$request->input('name'),
                'display_name'=>$request->input('desc_role'),
            ]
          );
          $permission=$request->input('permission_id');
          $role->permissions()->attach($permission);
          return redirect('admin/role/list')->with('status', 'Đã thêm nhóm quyền thành công'); 
    }
    function edit($id){
        $role=Role::find($id);
        $permissionChecked=$role->permissions;
        //return $role->id;
        $permissionParrent=Permission::where('parrent_id','0')->get();
        return view('admin.role.edit',compact('permissionParrent','role','permissionChecked'));
    }
    function update(Request $request,$id){
        if($request->input('name')==Role::find($id)->name){
            $request->validate(
                [
                'name' => 'required|string',
                'desc_role' => 'required|string',
                ],
                [
                    'unique'=>':attribute đã tồn tại',
                    'required'=>':attribute không được để trống',
                ],
                [
                    'name'=>'Tên nhóm quyền',
                    'desc_role'=>'Mô tả nhóm quyền'
                ]
            );
        }else{
            $request->validate(
                [
                'name' => 'required|string|unique:roles',
                'desc_role' => 'required|string',
                ],
                [
                    'unique'=>':attribute đã tồn tại',
                    'required'=>':attribute không được để trống',
                ],
                [
                    'name'=>'Tên nhóm quyền',
                    'desc_role'=>'Mô tả nhóm quyền'
                ]
            );
        }
       
        
        $role=Role::find($id);
        $role->update(
            [                
                'name'=>$request->input('name'),
                'display_name'=>$request->input('desc_role'),
            ]
          );
          $permission=$request->input('permission_id');
          $role->permissions()->sync($permission);
          return redirect('admin/role/list')->with('status', 'Đã cập nhật nhóm quyền thành công'); 
    }
    function delete($id){
        $this->authorize('delete_role');
        Role::where('id',$id)->forceDelete();
        return redirect('admin/role/list')->with('status', 'Bản ghi đã xóa thành công');
    }
}
