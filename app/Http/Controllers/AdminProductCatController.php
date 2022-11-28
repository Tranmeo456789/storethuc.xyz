<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product_cat;
use Illuminate\Support\Str;
class AdminProductCatController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next){
            session(['module_active'=>'product']);
            return $next($request);
        });
    }
    function list(){

        $data=Product_cat::all();
        function data_tree1( $data, $parent_id=0, $level=0){
            $result=[];
            foreach($data as $item){
                if($parent_id==$item['parent_id']){
                    $item['level']=$level;
                    $result[]=$item;
                    $child=data_tree1($data, $item['id'],$level+1);
                    $result=array_merge( $result,$child);
                }
            }
            return $result;
        }
        $product_cats=data_tree1( $data, 0);
        $num_cat=Product_cat::all()->count();     
        return view('admin.cat.product_cat',compact('product_cats', 'num_cat'));
    }
    // thêm
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
    
            Product_cat::create(
                [
                    'title'=>$request->input('cat_title'),
                    'parent_id'=>$request->input('parent_id'),
                    'slug'  => Str::slug($request->input('cat_title')), 
                ]
              );
            return redirect('admin/product/cat')->with('status', 'Đã thêm danh mục thành công');
        }       
    }
    //sửa
    function edit($id){
        $data=Product_cat::all();
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
        $product_cats=data_tree2( $data, 0);
        $product_cats_unset=[];
        foreach($product_cats as $cat){
            if($cat['id']!=$id){
                $product_cats_unset[]=$cat;
            }
        }
        //return $product_cats_unset;
        $num_cat=Product_cat::all()->count(); 
        $product_cat_current=Product_cat::find($id);

        return view('admin.cat.product_cat_edit',compact('product_cats', 'num_cat', 'product_cat_current','product_cats_unset'));
        
    }
    // cập nhật
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
            Product_cat::where('id', $id)->update(
                [
                    'title'=>$request->input('cat_title'),
                    'parent_id'=>$request->input('parent_id'),
                ]
            );
            return redirect('admin/product/cat')->with('status', 'Bạn đã cập nhật thành công');
        }
    }
    // xóa
    function delete($id){
        Product_cat::find($id)->delete();
        return redirect('admin/product/cat')->with('status', 'Bạn đã xóa tạm thời thành công');
    }
}
