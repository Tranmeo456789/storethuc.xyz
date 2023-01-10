<?php

namespace App\Http\Controllers;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    protected $moduleName = 'backend';
    protected $pageTitle          = 'Danh sách nhóm quyền';
    function __construct()
    {

        $this->middleware(function($request, $next){
            session(['module_active'=>'role']);
            return $next($request);
        });
    }
    function list(){
        $roles=Role::paginate(10);
        $pageTitle='';
        $moduleName='backend';
        return view('backend.pages.role.list',compact('roles','pageTitle','moduleName'));
    }
    function add(){
        $pageTitle='Danh sách nhóm quyền';
        $moduleName='backend';
        $permissionParrent=Permission::where('parrent_id','0')->get();
        return view('backend.pages.role.add',compact('permissionParrent','pageTitle','moduleName'));
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
          return redirect('backend/danh-sach-quyen')->with('status', 'Đã thêm nhóm quyền thành công'); 
    }
    function edit($id){
        $pageTitle='Danh sách nhóm quyền';
        $moduleName='backend';

        $role=Role::find($id);
        $permissionChecked=$role->permissions;
        $permissionParrent=Permission::where('parrent_id','0')->get();
        return view('backend.pages.role.edit',compact('permissionParrent','role','permissionChecked','pageTitle','moduleName'));
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
          return redirect('backend/danh-sach-quyen')->with('status', 'Đã cập nhật nhóm quyền thành công'); 
    }
    function delete($id){
        $this->authorize('delete_role');
        Role::where('id',$id)->forceDelete();
        return redirect('backend/danh-sach-quyen')->with('status', 'Bản ghi đã xóa thành công');
    }
}
