<?php

namespace App\Http\Controllers;
use App\Page;
use App\Post;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
class PostController extends Controller
{
    function showDetail($slugpost){
        $posts=Post::all();
        foreach($posts as $item4){
            if($slugpost==$item4->slug){
                $post=Post::find($item4->id);
            }
        }
        if(!empty($post)){
            $user=User::find($post->user_id);
            $time_created=Str::of($post->created_at)->substr(0,10);
            $pages=Page::all();
            $page_contact=Page::find(15);
            $page_introduce=Page::find(21);
            return view('client.post.detail', compact('page_contact','page_introduce','post','user','time_created'));
        }else{
            return view('client.page404');
        }
        
    }
}
