<?php

namespace App\Http\Controllers;

use App\Model\OrderModel;
use App\Model\UserModel;
use App\User;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    function __construct()
    {

        $this->middleware(function($request, $next){
            session(['module_active'=>'user']);
            return $next($request);
        });
    }
    // hiển thị danh sách
    function  list(Request $request){
        $active=0;$trash=0;
        $list_act=['delete' => 'Xóa tạm thời'];
            $keyword="";
        if($request->input('keyword')){
            $keyword=$request->input('keyword');
        }        
        $users=UserModel::where('name', 'LIKE', "%{$keyword}%")->paginate(10);
         $count_user_active=UserModel::count();
         $count_user_trash=User::onlyTrashed()->count();   
         $count=[$count_user_active, $count_user_trash];        
        return view('admin.user.list', compact('users', 'count', 'list_act','active','trash'));
    }  
    function list_active(Request $request){
        $active=1;$trash=0;
        $keyword="";
        if($request->input('keyword')){
            $keyword=$request->input('keyword');
        }
        $list_act=['delete' => 'Xóa tạm thời'];
        $users=UserModel::where('name', 'LIKE', "%{$keyword}%")->paginate(10);
        $count_user_active=UserModel::count();
         $count_user_trash=User::onlyTrashed()->count();   
         $count=[$count_user_active, $count_user_trash];        
        return view('admin.user.list', compact('users', 'count', 'list_act','active','trash'));
    }
    function list_trash(Request $request){
        $active=0;$trash=1;
        $keyword="";
        if($request->input('keyword')){
            $keyword=$request->input('keyword');
        }
        $list_act=[
                'restore' => 'Khôi phục',
                'forceDelete'=>'Xóa vĩnh viễn'
            ];
        $users=UserModel::onlyTrashed()->where('name', 'LIKE', "%{$keyword}%")->paginate(10);
        $count_user_active=UserModel::count();
         $count_user_trash=User::onlyTrashed()->count();   
         $count=[$count_user_active, $count_user_trash];        
        return view('admin.user.list', compact('users', 'count', 'list_act','active','trash'));
    }
    //thêm
    function add(){
        $roles=Role::all();
        return view('admin.user.add',compact('roles'));
        
    }
    // lưu trữ
    function store(Request $request){
        $request->validate(
            [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            ],
            [
                'required'=>':attribute không được để trống',
                'min'=>':attribute có độ dài ít nhất :min ký tự',
                'max'=>':attribute có độ dài tối đa :max ký tự',
                'confirmed'=>'xác nhận mật khẩu không thành công',
            ],
            [
                'name'=>'Tên người dùng',
                'email'=>'Email',
                'password'=>'Mật khẩu'
            ]
        );
        $user=UserModel::create(
            [                
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]
          );
          $role_user=$request->input('role_user');
          $user->roles1()->attach($role_user);
          return redirect('admin/user/list')->with('status', 'Đã thêm thành viên thành công');         
     }
     // xóa
     function delete($id){
        $this->authorize('delete_user');
         if(Auth::id()!=$id){
            UserModel::find($id)->delete();
             $orders=OrderModel::all();
             foreach($orders as $order){
                if($order['user_id']==$id){
                    OrderModel::where('id',$id)->update(['status_user' => "User đã bị xóa"]);
                }
             }
             return redirect('admin/user/list')->with('status', 'Đã xóa thành viên thành công');
         }
         else {
            return redirect('admin/user/list')->with('status', 'Bạn không thể tự xóa mình khỏi hệ thống');
         }
     }
     function forcedelete($id){
        $this->authorize('delete_user');
        if(Auth::id()!=$id){
            User::onlyTrashed()->where('id',$id)->forceDelete();         
            return redirect('admin/user/list')->with('status', 'Đã xóa thành viên thành công');
        }
        else {
           return redirect('admin/user/list')->with('status', 'Bạn không thể tự xóa mình khỏi hệ thống');
        }
     }
     // action xử lý các lựa chọn tác vụ
     function action(Request $request){
        
         if(!empty($request->input('btn-apply'))){
            $list_check=$request->input('list_check');
            if(!empty($list_check)){
               //echo $list_check[0];
               //echo count($list_check);
               //echo Auth::id();           
                 if($list_check[0]==Auth::id() && count($list_check)==1){               
                   return redirect('admin/user/list')->with('status', 'Bạn không thể thao tác trên tài khoản của bạn');
                 }
                foreach($list_check as $k => $id){
                    if(Auth::id()==$id){
                        unset($list_check[$k]);
                    }
                }            
                    $act = $request->input('act');
                     if($act =='start'){
                        return redirect('admin/user/list')->with('status', 'Bạn chưa chọn tác vụ để thực hiện');
                     }
                    if($act == 'delete'){
                        $this->authorize('delete_user');
                        UserModel::destroy($list_check);
                        return redirect('admin/user/list')->with('status', 'Bạn đã xóa thành công');
                    }
                    if($act=='restore'){
                        User::withTrashed()
                        ->whereIn('id', $list_check)
                        ->restore();
                        return redirect('admin/user/list')->with('status', 'Bạn đã khôi phục thành công');
                    }
                    if($act=='forceDelete'){
                        $this->authorize('delete_user');
                        User::withTrashed()
                       ->whereIn('id', $list_check)
                       ->forceDelete();
                       return redirect('admin/user/list')->with('status', 'Tài khoản lựa chọn đã xóa vĩnh viễn');
                   }       
            }else{
               return redirect('admin/user/list')->with('status', 'Bạn cần chọn phần tử để thực hiện');
            }
         }    
     }
     // sửa dữ liệu user
     function edit($id){
         $user=UserModel::find($id);
         $roles=Role::all();
         $roleUser=$user->roles1;
         return view('admin.user.edit', compact('user','roles','roleUser'));
     }
     // cập nhật lại dữ liệu
     function update(REQUEST $request,$id){
        $request->validate(
            [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            ],
            [
                'required'=>':attribute không được để trống',
                'min'=>':attribute có độ dài ít nhất :min ký tự',
                'max'=>':attribute có độ dài tối đa :max ký tự',
                'confirmed'=>'xác nhận mật khẩu không thành công',
            ],
            [
                'name'=>'Tên người dùng',
                'password'=>'Mật khẩu'
            ]
        );
        UserModel::where('id',$id)->update(
            [                
                'name'=>$request->input('name'),
                'password' => Hash::make($request->input('password')),
            ]
          );
          $user=UserModel::find($id);
          $role_user=$request->input('role_user');
          $user->roles1()->sync($role_user);  
          return redirect('admin/user/list')->with('status', 'Đã cập nhật thành công');
    }
}
