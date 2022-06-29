<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminSliderController extends Controller

{
    function __construct()
    {
        $this->middleware(function($request, $next){
            session(['module_active'=>'slider']);
            return $next($request);
        });
    }
    function add(Request $request){
        $request->validate(
            [
            'file' => 'required',                       
            ],
            [
                'required'=>':attribute không được để trống',
                                      
            ],
            [
                'file'=>'Ảnh',               
            ]
        );
        $image='';
        if($request->hasFile('file')){
            $file=$request->file;
            //return $file->getClientOriginalName();
            $filename = $file->getClientOriginalName();
            
            $type_allow = array('jpg', 'png', 'gif','jpeg');
            $type = pathinfo($filename, PATHINFO_EXTENSION);
            if(!in_array(strtolower($type), $type_allow)){
                //$error='File không đúng định dạng, cần chọn file có đuôi là: jpg, png, gif, jpeg';
                return redirect('admin/slider/list')->with('error','File không đúng định dạng, cần chọn file có đuôi là: jpg, png, gif, jpeg');
            }
            
            $path = $file->move('public/uploads/images/product', $file->getClientOriginalName());
            $image='uploads/images/product/'.$filename;   
        }
        $num_open=Slider::where('status','Công khai')->count();
        $num_wait=Slider::where('status','Chờ duyệt')->count();
        if($request->input('status')=='Công khai'){
            
            $localtion=$num_open+1;
        }else{
            $localtion=0;
        }
      
        $user_id = User::find(Auth::id())->get();
        Slider::create(
            [                 
                'image' =>$image,
                'user_id' => Auth::id(),
                'name_user'=> $user_id[0]->name,
                'status' => $request->input('status'),  
                'location'=>$localtion,            
            ]
            );
            return redirect('admin/slider/list')->with('status','Bạn đã thêm ảnh thành công');
    }
    function list(Request $request){
        //$open=$request->input('status');
        $num_open=Slider::where('status','Công khai')->count();
        $num_wait=Slider::where('status','Chờ duyệt')->count();
        if($request->input('status')=='wait'){
            $wait=1;
            $sliders=Slider::orderBy('updated_at','desc')->where('status','Chờ duyệt')->get();
        return view('admin.slider.list_slider',compact('sliders','num_open','num_wait','wait'));
        }
        $sliders=Slider::orderBy('location')->where('status','Công khai')->get();
        return view('admin.slider.list_slider',compact('sliders','num_open','num_wait'));
    }
    function forcedelete($id){
        $this->authorize('delete_slider');
        Slider::find($id)->forcedelete();
        return redirect('admin/slider/list')->with('status','Bạn đã xóa ảnh thành công');
    }
    function up($id){
        $item_current=Slider::find($id);
        Slider::where('location', $item_current['location']-1)->update(
            [                  
                'location'=>$item_current['location']+1,        
            ]
          );
        Slider::where('id', $id)->update(
            [                  
                'location'=>$item_current['location']-1,        
            ]
          );
          
        // return $item_current['location']-1;
        return redirect('admin/slider/list')->with('status','Vị trí hiển thị ảnh đã được thay đổi');
    }
    function change_status($id){
        $item_current=Slider::find($id);
        $num_open=Slider::where('status','Công khai')->count();
        //return $item_current['status'];
        
        //return $item_next;
        if($item_current['status']=='Chờ duyệt'){
            Slider::where('id',$id)->update(
                [                  
                    'status'=>'Công khai', 
                    'location'=>  $num_open+1,     
                ]
              );
        }else{
            $item_nexts=Slider::where('location','>',$item_current['location'])->get();
            foreach($item_nexts as $item_next){
                Slider::where('id',$item_next['id'])->update(
                    [                   
                        'location'=>  $item_next['location']-1,     
                    ]
                  );
            }
            Slider::where('id',$id)->update(
                [                  
                    'status'=>'Chờ duyệt',  
                    'location'=> 0,      
                ]
              );
        }
        
          return redirect('admin/slider/list')->with('status','Cập nhật trạng thái thành công');
    }
}
