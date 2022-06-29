<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post_cat;
class AdminPostCatController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next){
            session(['module_active'=>'post']);
            return $next($request);
        });
    }
    function list(){

        $data=Post_cat::all();
        //$parent_id = $data[0]['parent_id'];
        //return $parent_id;
        function data_tree( $data, $parent_id=0, $level=0){
            $result=[];
            foreach($data as $item){
                if($parent_id==$item['parent_id']){
                    $item['level']=$level;
                    $result[]=$item;
                    $child=data_tree($data, $item['id'],$level+1);
                    $result=array_merge( $result,$child);
                }
            }
            return $result;
        }
        $post_cats=data_tree( $data, 0);        
         //return ( $post_cat);
         $num_cat=Post_cat::all()->count();
        return view('admin.cat.post_cat',compact('post_cats', 'num_cat'));
    }
    // thêm danh mục
    function add(Request $request){
        if($request->input('add_cat')){
            $request->validate(
                [
                  'cat_title' => 'required|string|max:255',           
                ],
                [
                    'required'=>':attribute không được để trống',
                ],
                [
                    'cat_title'=>'Tiêu đề',
                ]
            );
    
            Post_cat::create(
                [
                    'title'=>$request->input('cat_title'),
                    'parent_id'=>$request->input('parent_id'),
                   
                ]
              );
            return redirect('admin/post/cat')->with('status', 'Đã thêm danh mục thành công');
        }       
    }
    //sửa
    function edit($id){
        $data=Post_cat::all();
        function data_tree2( $data, $parent_id=0, $level=0){
            $result=[];
            foreach($data as $item){
                if($parent_id==$item['parent_id']){
                    $item['level']=$level;
                    $result[]=$item;
                    $child=data_tree2($data, $item['id'],$level+1);
                    $result=array_merge( $result,$child);
                }
            }
            return $result;
        }
        $post_cats=data_tree2( $data, 0);
        $post_cats_unset=[];
        foreach($post_cats as $cat){
            if($cat['id']!=$id){
                $post_cats_unset[]=$cat;
            }
        }
        //return $post_cats_unset;
        $num_cat=Post_cat::all()->count(); 
        $post_cat_current=Post_cat::find($id);

        return view('admin.cat.post_cat_edit',compact('post_cats', 'num_cat', 'post_cat_current','post_cats_unset'));    
    }
    //cập nhật
    function update(Request $request, $id){
        if($request->input('edit_cat'))
        {
            $request->validate(
                [
                  'cat_title' => 'required|string|max:255',           
                ],
                [
                    'required'=>':attribute không được để trống',
                ],
                [
                    'cat_title'=>'Tiêu đề',
                ]
            ); 
            Post_cat::where('id', $id)->update(
                [
                    'title'=>$request->input('cat_title'),
                    'parent_id'=>$request->input('parent_id'),
                ]
            );
            return redirect('admin/post/cat')->with('status', 'Bạn đã cập nhật thành công');
        }
    }
    // xóa
    function delete($id){
        $this->authorize('delete_cat_post');
        Post_cat::find($id)->delete();
        return redirect('admin/post/cat')->with('status', 'Bạn đã xóa bản ghi thành công');
    }
}
