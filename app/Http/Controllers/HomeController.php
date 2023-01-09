<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\PageModel;

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
        return view('home');
    }
    
    function pages($slugpage){
        
       
        // else{
        //     return view('client.page404');
        // }    
        return view('client.page.index',compact('slugpage'));
    }
    

}
