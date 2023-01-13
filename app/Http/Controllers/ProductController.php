<?php

namespace App\Http\Controllers;
use App\Model\ProductModel;


use Illuminate\Http\Request;

use App\Model\CatProductModel;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    function __construct(){
        
    }
    function list_search(Request $request){
        $key="";
        if($request->input('key')){
            $key=$request->input('key');
            $params['keyword']=$key;
            $product_searchs=(new ProductModel)->listItems($params,['task'=>'list-items-search']);
             return view('client.product.list_search',compact('product_searchs'));
        }else{
            if(Auth::check()){
                return redirect('home');
            }else{
                return redirect('/');
            }        
        }      
    }
    function all_product(){
        return view('client.product.all_product');
    }
    
    function detail($slug){   
        $productCurrent=(new ProductModel)->getItem(['slug'=>$slug],['task'=>'get-item-in-slug']);
        return view('client.product.detail',compact('slug','productCurrent'));
    }
    function list_product($slug){
        $itemCatProduct=(new CatProductModel)->getItem(['slug'=>$slug],['task'=>'get-item-slug']);
        
        if($itemCatProduct){
            
            return view('client.product.list_product_cat0',compact('slug'));
        }
        else{
            return view('client.page404');
        }
        
    }
    function searchProductAjax(Request $request){
        $data=$request->all();
        $keyword=$data['key_word'];
        if($keyword){
            $params['keyword']=$keyword;
            $params['limit']=4;
            $result=(new ProductModel)->listItems($params,['task'=>'list-items-search']);
            $output='';
            foreach($result as $item){
                    $output.='
                    <li class="product-suggest">
                        <a href="">
                            <div class="item-img">
                                <div class="wp-img-search">
                                    <img src="'.asset($item->thumbnail).'">
                                </div>
                            </div>
                            <div class="item-info">
                                <p class="product-name truncate2">'.$item->name.'</p>
                                <strong class="price-new">'.number_format($item->price, 0, "" ,"." ).'đ/'.$item->unitProduct->name.'</strong>
                            </div>    
                        </a>  
                    </li> 
                    ';
            }
            echo $output;
        }
        
    }
}
