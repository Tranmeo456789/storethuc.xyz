<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class AdminPageController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next){
            session(['module_active'=>'page']);
            return $next($request);
        });
    }
    //danh sách
    function list(Request $request){ 
        $open=0;$wait=0;$trash=0;
        $status=$request->input('status');
        $list_act=[
            'open'=>'Công khai',
            'wait'=> 'Chờ duyệt',
            'delete'=> 'Xóa tạm thời',   
        ];
        $keyword="";
        if($request->input('keyword')){
            $keyword=$request->input('keyword');        
        }
        $pages=Page::where('title', 'LIKE', "%{$keyword}%")->paginate(10);
        $count_open=count(Page::where('status', 'LIKE', "Công khai")->get());
        $count_wait=count(Page::where('status', 'LIKE', "Chờ duyệt")->get());
        $count_trash=Page::onlyTrashed()->count();
        $count=[$count_open,$count_wait,$count_trash];                        
        return view('admin.page.list', compact('pages','count','list_act', 'trash','open','wait'));
    }
    function list_open(Request $request){
        $open=1;$wait=0;$trash=0;
        $keyword="";
        if($request->input('keyword')){
            $keyword=$request->input('keyword');        
        }
        $pages=Page::where([['status', 'LIKE', "Công khai"],['title','LIKE',"%{$keyword}%"]])->paginate(10);
        $list_act=[
             'wait'=> 'Chờ duyệt',
             'delete'=> 'Xóa tạm thời'
        ]; 
        $count_open=count(Page::where('status', 'LIKE', "Công khai")->get());
        $count_wait=count(Page::where('status', 'LIKE', "Chờ duyệt")->get());
        $count_trash=Page::onlyTrashed()->count();
        $count=[$count_open,$count_wait,$count_trash];  
        return view('admin.page.list', compact('pages','count','list_act','trash','open','wait'));             
    }
    function list_wait(Request $request){
        $open=0;$wait=1;$trash=0;
        $keyword="";
        if($request->input('keyword')){
            $keyword=$request->input('keyword');        
        }
        $pages=Page::where([['status', 'LIKE', "Chờ duyệt"],['title','LIKE',"%{$keyword}%"]])->paginate(10);
        $list_act=[
             'wait'=> 'Công khai',
             'delete'=> 'Xóa tạm thời'
        ]; 
        $count_open=count(Page::where('status', 'LIKE', "Công khai")->get());
        $count_wait=count(Page::where('status', 'LIKE', "Chờ duyệt")->get());
        $count_trash=Page::onlyTrashed()->count();
        $count=[$count_open,$count_wait,$count_trash];  
        return view('admin.page.list', compact('pages','count','list_act','trash','open','wait'));             
    }
    function list_trash(Request $request){
        $open=0;$wait=0;$trash=1;
        $keyword="";
        if($request->input('keyword')){
            $keyword=$request->input('keyword');        
        }
        $pages=Page::onlyTrashed()->where('title','LIKE',"%{$keyword}%")->paginate(10);
        $list_act=[
             'restore'=> 'Khôi phục',
             'delete'=> 'Xóa vĩnh viễn'
        ]; 
        $count_open=count(Page::where('status', 'LIKE', "Công khai")->get());
        $count_wait=count(Page::where('status', 'LIKE', "Chờ duyệt")->get());
        $count_trash=Page::onlyTrashed()->count();
        $count=[$count_open,$count_wait,$count_trash];  
        return view('admin.page.list', compact('pages','count','list_act','trash','open','wait'));             
    }
    // thêm bài viết
    function add(){
        return view('admin.page.add');       
    }
    //lưu trữ bài viết
    function store(Request $request){
        if($request->input('btn_add_page')){
            $request->validate(
                [
                'title_page' => 'required|string|min:1',
                'content_page' => 'required|string|min:1',
                ],
                [
                    'required'=>':attribute không được để trống',
                    'min'=>':attribute có độ dài ít nhất :min ký tự',                  
                ],
                [
                    'title_page'=>'Tiêu đề',
                    'content_page'=>'Nội dung',
                ]
            );
            
            Page::create(
                [                
                    'title' => $request->input('title_page'),
                    'content' => $request->input('content_page'),
                    'user_id' => Auth::id(),
                    'slug' => Str::slug($request->input('title_page')),
                    'status' => $request->input('status'),      
                ]
              );
            return redirect('admin/page/list')->with('status','Bạn đã thêm trang thành công');
        }
        
    }
    // xóa bải viết
    function delete($id){
        $this->authorize('delete_page');
        Page::find($id)->delete();
        return redirect('admin/page/list')->with('status','Bạn đã xóa thành công!');
    }
    // xóa vĩnh viễn
    function forcedelete($id){
        $this->authorize('delete_page');
        Page::withTrashed()
                    ->where('id',$id)
                    ->forceDelete();
        return redirect('admin/page/list')->with('status','Bản ghi đã xóa vĩnh viễn!');
    }
    // sửa bài viết
    function edit($id){
        $page=Page::find($id);
        return view('admin.page.edit', compact('page'));
    }
    // cập nhật bài viết
    function update(Request $request, $id){
        if($request->input('btn_add_page')){
            $request->validate(
                [
                'title_page' => 'required|string|min:1',
                'content_page' => 'required|string|min:1',
                ],
                [
                    'required'=>':attribute không được để trống',
                    'min'=>':attribute có độ dài ít nhất :min ký tự',                  
                ],
                [
                    'title_page'=>'Tiêu đề',
                    'content_page'=>'Nội dung',
                ]
            ); 
            Page::where('id', $id)->update(
                [                
                    'title' => $request->input('title_page'),
                    'content' => $request->input('content_page'),
                    'user_id' => Auth::id(),
                    'slug' => Str::slug($request->input('title_page')),
                    'status' => $request->input('status'),         
                ]
              );
              return redirect('admin/page/list')->with('status', 'Bạn đã cập nhật thành công');
        }
        
    }
    // tìm kiếm
    function search(Request $request){
        if($request->has('keyword')){
            $keyword=$request->keyword;
            $result=Page::where('title', 'like','%'.$keyword.'%')->get();
            return response()->json(['data' => $result]);
        }
        else{
            return view('admin.page.list');
        }
        
    }

    function action(Request $request){
        $list_check=$request->input('list_check');
        if(!empty($list_check)){
            $act=$request->input('act');
            if($act=='open'){
                foreach($list_check as $id){
                    if(Page::where('id', $id) && Page::where('status', "Công khai")){
                        unset($list_check[$id]);
                    }
                    Page::where('id', $id)->update(
                        [                
                            'status' => "Công khai",        
                        ]
                      );
                } 
                return redirect('admin/page/list')->with('status', 'Trạng thái được chuyển thành công');      
            }
            if($act=='wait'){
                foreach($list_check as $id){
                    if(Page::where('id', $id) && Page::where('status', "Chờ duyệt")){
                        unset($list_check[$id]);
                    }
                    Page::where('id', $id)->update(
                        [                
                            'status' => "Chờ duyệt",        
                        ]
                      );
                } 
                return redirect('admin/page/list')->with('status', 'Trạng thái được chuyển thành công');      
            }
            if($act=='delete'){ 
                $this->authorize('delete_page');              
                    Page::destroy($list_check);
                    return redirect('admin/page/list')->with('status', 'Bản ghi đã đưa vào thùng rác');     
                }
            if($act=='forcedelete'){   
                $this->authorize('delete_page');            
                    Page::withTrashed()
                    ->whereIn('id',$list_check)
                    ->forceDelete();
                    return redirect('admin/page/list')->with('status', 'Bản ghi đã xóa vĩnh viễn');     
                }  
                if($act=='restore'){               
                    Page::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                    return redirect('admin/page/list')->with('status', 'Bạn đã khôi phục thành công');     
            }
            if($act =='start'){
                return redirect('admin/page/list')->with('status', 'Bạn cần chọn tác vụ để thực hiện');
             }        
        }
        else{
            return redirect('admin/page/list')->with('status', 'Bạn cần chọn phần tử để thực hiện');
        }

    }
}
