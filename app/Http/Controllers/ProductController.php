<?php

namespace App\Http\Controllers;
use App\Product;
use App\Product_cat;
use App\Product_cat_child;
use Illuminate\Http\Request;
use App\Post;
use App\Page;
use App\Color_product;
use App\Image_product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    function __construct(){
        $pages=Page::all();
        $page_contact=Page::find(15);
        $page_introduce=Page::find(21);
        $posts=Post::all();
        $_SESSION['cat_product']=Product_cat::all();
        $_SESSION['cat_product_child']=Product_cat_child::all();
        $_SESSION['product_sellign']=Product::inRandomOrder()->limit(8)->get();
        
        $_SESSION['product']=Product::all();
    }
    function list_search(Request $request){
        $pages=Page::all();
        $page_contact=Page::find(15);
        $page_introduce=Page::find(21);
        $key="";
        if($request->input('key')){
            $key=$request->input('key');
            $product_searchs=Product::where('name','LIKE',"%{$key}%")->get();
             return view('client.product.list_search',compact('pages','page_contact','page_introduce','product_searchs'));
        }else{
            if(Auth::check()){
                return redirect('home');
            }else{
                return redirect('/');
            }
            
        }      
    }
    function all_product(){
        $pages=Page::all();
        $page_contact=Page::find(15);
        $page_introduce=Page::find(21);
        $posts=Post::all();
        
        return view('client.product.all_product',compact('pages','page_contact','page_introduce'));
    }
    
    function list_product1($slug1){
        $page_contact=Page::find(15);
        $page_introduce=Page::find(21);
        $posts=Post::all();
         $cat1_id_products=Product_cat::where('slug',$slug1)->get();
         $products=Product::where('slug',$slug1)->get();
         foreach($products as $product1){
             $product=$product1;
         }
        foreach($cat1_id_products as $cat1_id_product){
             $cat1_id_product=$cat1_id_product['id'];
         }
         if(!empty($cat1_id_product)){
            $_SESSION['cat_product']=Product_cat::all();
            $_SESSION['cat_product_child']=Product_cat_child::all();
            $_SESSION['product_sellign']=Product::inRandomOrder()->limit(8)->get();
            
            $_SESSION['product']=Product::all();
            return view('client.product.list_product_cat1',compact('cat1_id_product','page_contact','page_introduce','posts'));
         }else if(!empty($product)){
           
            $images=Image_product::all();
            $image_products=[];
            foreach($images as $image2){
                if($product['id']==$image2['product_id']){
                    $image_products[]=$image2;
                }
            }
            $product_like_cat=Product::where([
                ['id','<>',$product->id],
            ])->inRandomOrder()->limit(7)->get();
           
            return view('client.product.detail',compact('slug1','product','page_contact','page_introduce','posts','image_products','product_like_cat'));
         }
         else{
            return view('client.page404');
         }  
    }
    function list_product($slug){
        $page_contact=Page::find(15);
        $page_introduce=Page::find(21);
        $posts=Post::all();
        $cat0_id_products=Product_cat::where('slug',$slug)->get();
        $cat0_id_product=$cat0_id_products[0];
        if(!empty($cat0_id_product)){
            $product_sellign_like_cats=Product::where('cat_id',$cat0_id_product['id'])->inRandomOrder()->limit(8)->get();
            return view('client.product.list_product_cat0',compact('slug','page_contact','page_introduce','posts','product_sellign_like_cats'));
        }
        else{
            return view('client.page404');
        }
        
    }
    function searchProductAjax(Request $request){
        $data=$request->all();
        $keyword=$data['key_word'];
        if($keyword){
            $result=Product::where('name','LIKE',"%{$keyword}%")->inRandomOrder()->limit(4)->get();
            $output='';
            foreach($result as $item){
                if(!empty($item->price_old)){
                    $output.='
                    <li class="product-suggest">
                        <a href="">
                            <div class="item-img">
                                <div class="wp-img-search">
                                    <img src="'.asset($item->thumbnail).'">
                                </div>
                            </div>
                            <div class="item-info">
                                <h3 class="product-name">'.$item->name.'</h3>
                                <strong class="price-new">'.number_format($item->price_current, 0, "" ,"." ).'đ</strong>
                                <span class="price-old">'.number_format($item->price_old, 0, "" ,"." ).'đ</span> 
                            </div>    
                        </a>  
                    </li> 
                    '; 
                }else{
                    $output.='
                    <li class="product-suggest">
                        <a href="">
                            <div class="item-img">
                                <div class="wp-img-search">
                                    <img src="'.asset($item->thumbnail).'">
                                </div>
                            </div>
                            <div class="item-info">
                                <h3 class="product-name truncate2">'.$item->name.'</h3>
                                <strong class="price-new mt-2">'.number_format($item->price_current, 0, "" ,"." ).'đ / '.$item->unit.'</strong>
                                 
                            </div>    
                        </a>  
                    </li> 
                    ';
                }
                
            }
            echo $output;
        }
        
    }
}
