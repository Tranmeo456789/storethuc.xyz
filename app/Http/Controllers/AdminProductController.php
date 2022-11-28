<?php

namespace App\Http\Controllers;
use App\Product_cat;
use App\Product_cat_child;
use Illuminate\Http\Request;

use App\Color_product;
use App\Image_product;
use Illuminate\Support\Str;
use App\Product;
use Illuminate\Support\Facades\Auth;

use Stringable;

class AdminProductController extends Controller
{

    function __construct()
    {
        $this->middleware(function($request, $next){
            session(['module_active'=>'product']);
            return $next($request);
        });
    }
    function add_img($id){
       $product=Product::find($id);
       $colors=Color_product::all();
       $product_imgs=Image_product::where('product_id',$id)->get();
        return view('admin.product.add_img',compact('product','colors','product_imgs'));
    }
    function delete_img($id,$id_img){
        $this->authorize('delete_img');
        Image_product::find($id_img)->forcedelete();
        return redirect()->route('product.add_img', ['id'=>$id])->with('status','Xóa hình ảnh thành công');
     }
    function update_img(Request $request,$id){  
        
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
            $filename = $file->getClientOriginalName();            
            $type_allow = array('jpg', 'png', 'gif','jpeg');
            $type = pathinfo($filename, PATHINFO_EXTENSION);
            if(!in_array(strtolower($type), $type_allow)){
                return redirect()->route('product.add_img', ['id'=>$id])->with('error','File không đúng định dạng, cần chọn file có đuôi là: jpg, png, gif, jpeg');
            }            
            $path = $file->move('public/uploads/images/product', $file->getClientOriginalName());
            $image='uploads/images/product/'.$filename;   
        }
        if($request->input('color_product')){
            $id_color=$request->input('color_product');
            $color=Color_product::find($id_color);
             Image_product::create(
            [                 
                'product_id' => $id,
                'color_id' => $request->input('color_product'),
                'image' =>  $image,
                'name_color' => $color->name_color,
                'code_color' => $color->code_color
            ]
          );
        }else{
            Image_product::create(
            [                 
                'product_id' => $id,
                'color_id' => $request->input('color_product'),
                'image' =>  $image,
            ]
          );
        }
        return redirect()->route('product.add_img', ['id'=>$id])->with('status','Thêm hình ảnh thành công');   
    }
    function list_image(){
        return view('admin.product.list_image');
    }
    function list_color(){
        
        $color_products=Color_product::orderBy('created_at','desc')->paginate(10);
        return view('admin.product.list_color',compact('color_products'));
    }
    function add_color(Request $request){
        
        $request->validate(
            [
            'name_color' => 'required|string|min:1',           
            
            ],
            [
                'required'=>':attribute không được để trống',
                'min'=>':attribute có độ dài ít nhất :min ký tự',                  
            ],
            [
                'name_color'=>'Tên màu',               
            ]
        );
      
        Color_product::create(
            [      
                         
                'name_color' => $request->input('name_color'),
                'code_color' => $request->input('color_select'),
            ]
          );
         return redirect('admin/product/list_color')->with('status','Bạn đã thêm màu thành công');        
    }
    function delete_color($id){
        $this->authorize('delete_color');
        Color_product::find($id)->forcedelete();
        return redirect('admin/product/list_color')->with('status','Bạn đã xóa  màu thành công'); 
    }
    function list(Request $request){  
          $trash=0;
          $still=0;
          $wait=0;
        $keyword_product="";                
         if($request->input('search_product')!=null){
            $keyword_product=$request->input('keyword_product');
            $products=Product::where('name', 'LIKE', "%{$keyword_product}%")->paginate(10);
        }
        $products=Product::where('name', 'LIKE', "%{$keyword_product}%")->orderBy('updated_at','desc')->paginate(10);  
        $list_act=[
            'still'=>'Còn hàng',
            'wait'=> 'Hết hàng',
            'delete'=> 'Xóa tạm thời',
        ];
        $cat_products=Product_cat::all();
        $count_still=count(Product::where('status', 'LIKE', "Còn hàng")->get());
        $count_wait=count(Product::where('status', 'LIKE', "Hết hàng")->get());
        $count_trash=Product::onlyTrashed()->count();
        $count=[$count_still,$count_wait,$count_trash];
        return view('admin.product.list',compact('products', 'cat_products', 'count','list_act','keyword_product','trash','still','wait'));
    }
    // list còn hàng
    function list_still(Request $request){
        $trash=0;
        $still=1;
        $wait=0;
        $products=Product::where('status', 'LIKE', "Còn hàng")->paginate(10);
        $keyword_product=""; 
        $list_act=[
            'wait'=> 'Hết hàng',
            'delete'=> 'Xóa tạm thời',
        ];
        $cat_products=Product_cat::all();
        $count_still=count(Product::where('status', 'LIKE', "Còn hàng")->get());
        $count_wait=count(Product::where('status', 'LIKE', "Hết hàng")->get());
        $count_trash=Product::onlyTrashed()->count();
        $count=[$count_still,$count_wait,$count_trash];
        return view('admin.product.list',compact('products', 'cat_products', 'count','list_act','keyword_product','trash','still','wait'));
    }
    //list hết hàng
    
    function list_wait(Request $request){ 
        $trash=0;
        $still=0;
        $wait=1;
        $products=Product::where('status', 'LIKE', "Hết hàng")->paginate(10);
        $keyword_product=""; 
        $list_act=[
            'still'=> 'Còn hàng',
            'delete'=> 'Xóa tạm thời'
        ];
        $cat_products=Product_cat::all();
        $count_still=count(Product::where('status', 'LIKE', "Còn hàng")->get());
        $count_wait=count(Product::where('status', 'LIKE', "Hết hàng")->get());
        $count_trash=Product::onlyTrashed()->count();
        $count=[$count_still,$count_wait,$count_trash];
        return view('admin.product.list',compact('products', 'cat_products', 'count','list_act','keyword_product','trash','still','wait'));
    }
    // list thùng rác
    function list_trash(Request $request){   
        $keyword_product=""; 
        $trash=1;
        $still=0;
        $wait=0;
           $list_act=[
               'restore'=> 'Khôi phục',
               'forcedelete'=> 'Xóa vĩnh viễn'
           ];
        if($request->input('search_product')!=null){
            $keyword_product=$request->input('keyword_product');
            $products=Product::where('name', 'LIKE', "%{$keyword_product}%")->onlyTrashed()->paginate(10);
        }
        $products = Product::where('name', 'LIKE', "%{$keyword_product}%")->onlyTrashed()->paginate(10);
        $cat_products=Product_cat::all();
        $count_still=count(Product::where('status', 'LIKE', "Còn hàng")->get());
        $count_wait=count(Product::where('status', 'LIKE', "Hết hàng")->get());
        $count_trash=Product::onlyTrashed()->count();
        $count=[$count_still,$count_wait,$count_trash];
        return view('admin.product.list',compact('products', 'cat_products', 'count','list_act','keyword_product','trash','still','wait'));
    }
    function add(Request $request){    
        $data=Product_cat::all();  
        
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
        $cat_products=data_tree( $data, 0);
        $cat_product_childs=Product_cat_child::all();  
        return view('admin.product.add', compact('cat_products','cat_product_childs'));
    }
    // chọn danh mục
    public function selectCat(Request $request){
        // if($request->has('cat_id')){
        //     $cat_id=$request->cat_id;
        //     $cat_id_childs=Product_cat_child::where('parent_id',$cat_id)->get();
        //     return response()->json(['data' => $cat_id_childs]);
        // }

       $data=$request->all();
       $cat_id=$data['cat_id'];
        $output="";
        $cat_id_childs=Product_cat_child::where('parent_id',$cat_id)->get();
        $output.="<option value=''>Chọn danh mục con</option>";
        foreach($cat_id_childs as $cat_id_child){
            $output.="<option value=".$cat_id_child->id.">".$cat_id_child->title."</option>";
        }
        echo $output;
    }
       
   
    // lưu trữ
    function store(Request $request){
        if($request->input('add_product')){
            
            $request->validate(
                [
                'product_name' => 'required|string|min:1',
                'price'=> 'required|numeric|min:1',
                'describe'=> 'required|string|min:1',
                'product_content'=> 'required|string|min:1',
                'product_cat' => 'required',
                ],
                [
                    'numeric' => ':attribute là số nguyên',
                    'required'=>':attribute không được để trống',
                    'min'=>':attribute có độ dài ít nhất :min ký tự',                  
                ],
                [
                    'product_name'=>'Tên sản phẩm',
                    'price'=>'Giá sản phẩm',
                    'describe'=>'Mô tả ngắn',
                    'product_content'=>'Nội dung',
                    'product_cat' => 'Danh mục cha',
                ]
            );
            $thumbnail="";
            if($request->hasFile('file')){
                $file=$request->file;
                //return $file->getClientOriginalName();
                $filename = $file->getClientOriginalName();
                $path = $file->move('public/uploads/images/product', $file->getClientOriginalName());
                $thumbnail='uploads/images/product/'.$filename;   
            }
          
            Product::create(
                [      
                             
                    'name' => $request->input('product_name'),
                    'thumbnail' => $thumbnail,
                    'describe'=>$request->input('describe'),
                    'price_current'=>$request->input('price'),
                    'unit' => $request->input('unit'),
                    'content' => $request->input('product_content'),
                    'user_id' => Auth::id(),
                    'cat_id' => $request->input('product_cat'),
                    'status' => $request->input('status'),
                    'slug'  => Str::slug($request->input('product_name')),   
                ]
              );
             return redirect('admin/product/list')->with('status','Bạn đã thêm sản phẩm thành công');
        }
    }
    // sửa
    function edit($id){
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
        $cat_products=data_tree1( $data, 0); 
        $product=Product::find($id);
        $cat_product_childs=Product_cat_child::all(); 
        return view('admin.product.edit',compact('cat_products', 'product','cat_product_childs'));
    }
    // cập nhật
    function update(Request $request, $id){
        if($request->input('update_product'))
        {
            if($request->input('price_old')){
                $request->validate(
                    [
                    'product_name' => 'required|string|min:1',
                    'price'=> 'required|numeric|min:1',
                    'price_old' => 'numeric',
                    'describe'=> 'required|string|min:1',
                    'product_content'=> 'required|string|min:1',
                    'product_cat' => 'required',
                    ],
                    [
                        'numeric' => ':attribute là số',
                        'required'=>':attribute không được để trống',
                        'min'=>':attribute có độ dài ít nhất :min ký tự', 
    
                    ],
                    [
                        'product_name'=>'Tên sản phẩm',
                        'price'=>'Giá sản phẩm',
                        'price_old' => 'Giá cũ',
                        'describe'=>'Mô tả ngắn',
                        'product_content'=>'Nội dung',   
                        'product_cat'=>'Danh mục cha',                
                    ]
                );
            }else{
                $request->validate(
                    [
                    'product_name' => 'required|string|min:1',
                    'price'=> 'required|numeric|min:1',
                    'describe'=> 'required|string|min:1',
                    'product_content'=> 'required|string|min:1',
                    'product_cat' => 'required',
                    ],
                    [
                        'numeric' => ':attribute là số',
                        'required'=>':attribute không được để trống',
                        'min'=>':attribute có độ dài ít nhất :min ký tự', 
    
                    ],
                    [
                        'product_name'=>'Tên sản phẩm',
                        'price'=>'Giá sản phẩm',
                        'price_old' => 'Giá cũ',
                        'describe'=>'Mô tả ngắn',
                        'product_content'=>'Nội dung',   
                        'product_cat'=>'Danh mục cha',                
                    ]
                );
            }
            $request->validate(
                [
                'product_name' => 'required|string|min:1',
                'price'=> 'required|numeric|min:1',
                // 'price_old' => 'numeric',
                'describe'=> 'required|string|min:1',
                'product_content'=> 'required|string|min:1',
                'product_cat' => 'required',
                ],
                [
                    'numeric' => ':attribute là số',
                    'required'=>':attribute không được để trống',
                    'min'=>':attribute có độ dài ít nhất :min ký tự', 

                ],
                [
                    'product_name'=>'Tên sản phẩm',
                    'price'=>'Giá sản phẩm',
                    'price_old' => 'Giá cũ',
                    'describe'=>'Mô tả ngắn',
                    'product_content'=>'Nội dung',   
                    'product_cat'=>'Danh mục cha',                
                ]
            );
            $thumbnail="";
            if($request->hasFile('file')){
                $file=$request->file;
                //return $file->getClientOriginalName();
                $filename = $file->getClientOriginalName();
                $path = $file->move('public/uploads/images/product', $file->getClientOriginalName());
                $thumbnail='uploads/images/product/'.$filename;   
            }
            if($request->input('price_old')){
                Product::where('id', $id)->update(
                    [
                        'name' => $request->input('product_name'),
                        'thumbnail' => $thumbnail,
                        'describe'=>$request->input('describe'),
                        'price_current'=>$request->input('price'),
                        'price_old' => $request->input('price_old'),
                        'content' => $request->input('product_content'),
                        'user_id' => Auth::id(),
                        'cat_id' => $request->input('product_cat'),
                        'cat_id_child' => $request->input('product_cat_child'),
                        'status' => $request->input('status'),
                        'slug'  => Str::slug($request->input('product_name')), 
                    ]
                );
            }else{
                Product::where('id', $id)->update(
                    [
                        'name' => $request->input('product_name'),
                        'thumbnail' => $thumbnail,
                        'describe'=>$request->input('describe'),
                        'price_current'=>$request->input('price'),
                        
                        'content' => $request->input('product_content'),
                        'user_id' => Auth::id(),
                        'cat_id' => $request->input('product_cat'),
                        'cat_id_child' => $request->input('product_cat_child'),
                        'status' => $request->input('status'),
                        'slug'  => Str::slug($request->input('product_name')), 
                    ]
                );
            }
           
              
            return redirect('admin/product/list')->with('status', 'Bạn đã cập nhật thành công');
        }      
    }
    // xóa
    function delete($id){
        $this->authorize('delete_product');
        Product::where('id', $id)->delete();
        return redirect('admin/product/list')->with('status', 'Bạn đã xóa tạm thời thành công');
    }
    // xóa vĩnh viễn
    function forcedelete($id){
        $this->authorize('delete_product');
        Product::where('id', $id)->forcedelete();
        return redirect('admin/product/list')->with('status', 'Bạn đã xóa bản ghi khỏi thùng rác');
    }
    function action(Request $request){
        $list_check=$request->input('list_check');
        if(!empty($list_check)){
            $act=$request->input('act');
            if($act=='still'){
                foreach($list_check as $id){
                    if(Product::where('id', $id) && Product::where('status', "Còn hàng")){
                        unset($list_check[$id]);
                    }
                    Product::where('id', $id)->update(
                        [                
                            'status' => "Còn hàng",        
                        ]
                      );
                } 
                return redirect('admin/product/list')->with('status', 'Trạng thái được chuyển thành công');      
            }
            if($act=='wait'){
                foreach($list_check as $id){
                    if(Product::where('id', $id) && product::where('status', "Hết hàng")){
                        unset($list_check[$id]);
                    }
                    Product::where('id', $id)->update(
                        [                
                            'status' => "Hết hàng",        
                        ]
                      );
                } 
                return redirect('admin/product/list')->with('status', 'Trạng thái được chuyển thành công');      
            }
            if($act=='delete'){     
                $this->authorize('delete_product');          
                Product::destroy($list_check);
                    return redirect('admin/product/list')->with('status', 'Bản ghi đã đưa vào thùng rác');     
                }
            if($act=='forcedelete'){   
                $this->authorize('delete_product');            
                Product::withTrashed()
                    ->whereIn('id',$list_check)
                    ->forceDelete();
                    return redirect('admin/product/list')->with('status', 'Bản ghi đã xóa vĩnh viễn');     
                }  
               
                if($act=='restore'){               
                    Product::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                    return redirect('admin/product/list')->with('status', 'Bạn đã khôi phục thành công');     
                }
                    if($act =='start'){
                        return redirect('admin/product/list')->with('status', 'Bạn cần chọn tác vụ để thực hiện');
                     } 
            }
            
            else{
                return redirect('admin/product/list')->with('status', 'Bạn cần chọn phần tử để thực hiện');
             }
    }
}
