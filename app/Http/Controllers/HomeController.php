<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        //$_SESSION['product_sellign']=Product::inRandomOrder()->limit(8)->get();
        return view('home');
    }
    function pages($slugpage){
        
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
