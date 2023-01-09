<?php

namespace App\Http\Controllers;
use App\Model\PostModel;
use App\Model\CatPostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PostController extends Controller
{
    function list(){
        $posts=PostModel::all();
        $catPost=(new CatPostModel())->listItems(null,['task'=>'list-items-front-end']);
        return view('client.post.list',compact('catPost','posts'));
    }
    function detail($slug){
        $item=(new PostModel)->getItem(['slug'=>$slug],['task'=>'get-item-in-slug']);
        return view('client.post.detail',compact('slug','item'));
        
    }
}
