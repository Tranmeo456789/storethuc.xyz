<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_cat;
use App\Product_cat_child;
use App\Page;
use App\Post;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
       $pages=Page::all();
       $page_contact=Page::find(15);
       $page_introduce=Page::find(21);
        $_SESSION['cat_product']=Product_cat::all();
        $_SESSION['cat_product_child']=Product_cat_child::all();
        $_SESSION['product_sellign']=Product::inRandomOrder()->limit(8)->get();
        
        $_SESSION['product']=Product::all();
        return view('home',compact('pages','page_contact','page_introduce'));
    }
    function pages($slugpage){
        //return $slug_contact;
        $page_contact=Page::find(15);
        $page_introduce=Page::find(21);
        if($slugpage==$page_contact['slug']){
            return view('client.page.contact',compact('page_contact','page_introduce'));
        }
        else if($slugpage==$page_introduce['slug']){
            return view('client.page.introduce',compact('page_contact','page_introduce'));
        }else if($slugpage=='tin-tuc'){
            $posts=Post::all();
            return view('client.page.information',compact('page_contact','page_introduce','posts'));
        }
        else{
            return view('client.page404');
        }    
    }
    

}
