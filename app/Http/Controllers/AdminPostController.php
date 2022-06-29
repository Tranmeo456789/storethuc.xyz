<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Post_cat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next){
            session(['module_active'=>'post']);
            return $next($request);
        });
    }
    function list(Request $request){
        $open=0;$wait=0;$trash=0;       
        $keyword_post="";
        if($request->input('keyword_post')){
            $keyword_post=$request->input('keyword_post');
        }
        $list_act=[               
            'open'=> 'Công khai',
            'wait'=> 'Chờ duyệt',
            'delete'=>'Xóa tạm thời'
        ];     
        $posts=Post::where('title','LIKE',"%{$keyword_post}%")->paginate(10);       
        $cat_posts=Post_cat::all();
        $count_open=count(Post::where('status', 'LIKE', "Công khai")->get());
        $count_wait=count(Post::where('status', 'LIKE', "Chờ duyệt")->get());
        $count_trash=Post::onlyTrashed()->count();
        $count=[$count_open,$count_wait,$count_trash];
        return view('admin.post.list', compact('posts','cat_posts','list_act','count','trash','open','wait'));
    }
    function list_open(Request $request){
        $keyword_post="";
        $open=1;$wait=0;$trash=0;
        if($request->input('keyword_post')){
            $keyword_post=$request->input('keyword_post');
        }
        $list_act=[
            'wait'=> 'Chờ duyệt',
            'delete'=> 'Xóa tạm thời'
        ];
        $posts=Post::where([['status', 'LIKE', "Công khai"],['title','LIKE',"%{$keyword_post}%"]])->paginate(10);
        $cat_posts=Post_cat::all();
        $count_open=count(Post::where('status', 'LIKE', "Công khai")->get());
        $count_wait=count(Post::where('status', 'LIKE', "Chờ duyệt")->get());
        $count_trash=Post::onlyTrashed()->count();
        $count=[$count_open,$count_wait,$count_trash];
        return view('admin.post.list', compact('posts','cat_posts','list_act','count','trash','open','wait'));
    }
    function list_wait(Request $request){
        $keyword_post="";
        $open=0;$wait=1;$trash=0;
        if($request->input('keyword_post')){
            $keyword_post=$request->input('keyword_post');
        }
            $list_act=[
                'open'=> 'Công khai',
                'delete'=> 'Xóa tạm thời'
            ];
        $posts=Post::where([['status', 'LIKE', "Chờ duyệt"],['title','LIKE',"%{$keyword_post}%"]])->paginate(10);
        $cat_posts=Post_cat::all();
        $count_open=count(Post::where('status', 'LIKE', "Công khai")->get());
        $count_wait=count(Post::where('status', 'LIKE', "Chờ duyệt")->get());
        $count_trash=Post::onlyTrashed()->count();
        $count=[$count_open,$count_wait,$count_trash];
        return view('admin.post.list', compact('posts','cat_posts','list_act','count','trash','open','wait'));
    }
    function list_trash(Request $request){
        $keyword_post="";
        $open=0;$wait=0;$trash=1;
        if($request->input('keyword_post')){
            $keyword_post=$request->input('keyword_post');
        }
            $list_act=[               
                'restore'=> 'Khôi phục',
                'forcedelete'=> 'Xóa vĩnh viễn'
            ];
        $posts=Post::onlyTrashed()->where('title','LIKE',"%{$keyword_post}%")->paginate(10);
        $cat_posts=Post_cat::all();
        $count_open=count(Post::where('status', 'LIKE', "Công khai")->get());
        $count_wait=count(Post::where('status', 'LIKE', "Chờ duyệt")->get());
        $count_trash=Post::onlyTrashed()->count();
        $count=[$count_open,$count_wait,$count_trash];
        return view('admin.post.list', compact('posts','cat_posts','list_act','count','trash','open','wait'));
    }
    //thêm
    function add(){    
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
        $cat_posts=data_tree2( $data, 0);  
       
            
        return view('admin.post.add', compact('cat_posts'));
    }
    // lưu trữ
    function store(Request $request){
        if($request->input('add_post')){
            $request->validate(
                [
                'title_post' => 'required|string|min:1',
                'content_post' => 'required|string|min:1',
                ],
                [
                    'required'=>':attribute không được để trống',
                    'min'=>':attribute có độ dài ít nhất :min ký tự',                  
                ],
                [
                    'title_post'=>'Tiêu đề',
                    'content_post'=>'Nội dung',
                ]
            );
            $thumbnail="";
            if($request->hasFile('file')){
                $file=$request->file;
                //return $file->getClientOriginalName();
                $filename = $file->getClientOriginalName();
                $path = $file->move('public/uploads/images/post', $file->getClientOriginalName());
                $thumbnail='uploads/images/post/'.$filename;
                
            }

            Post::create(
                [                 
                    'title' => $request->input('title_post'),
                    'thumbnail' => $thumbnail,
                    'content' => $request->input('content_post'),
                    'user_id' => Auth::id(),
                    'cat_id' => $request->input('cat-post'),
                    'status' => $request->input('status'),    
                    'slug'  => Str::slug($request->input('title_post')),  
                ]
              );
             return redirect('admin/post/list')->with('status','Bạn đã thêm bài viết thành công');
        }
    }
    // sửa
    function edit($id){
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
        $cat_posts=data_tree( $data, 0);  
       
        $post=Post::find($id);
        return view('admin.post.edit', compact('cat_posts','post'));
    }
    // cập nhât
    function update(Request $request, $id){
        if($request->input('update_post'))
        {
            $request->validate(
                [
                'title_post' => 'required|string|min:1',
                'content_post' => 'required|string|min:1',
                ],
                [
                    'required'=>':attribute không được để trống',
                    'min'=>':attribute có độ dài ít nhất :min ký tự',                  
                ],
                [
                    'title_post'=>'Tiêu đề',
                    'content_post'=>'Nội dung',
                ]
            );
            $thumbnail="";
            if($request->hasFile('file')){
                $file=$request->file;
                //return $file->getClientOriginalName();
                $filename = $file->getClientOriginalName();
                $path = $file->move('public/uploads/images/post', $file->getClientOriginalName());
                $thumbnail='uploads/images/post/'.$filename;
                
            }
            Post::where('id', $id)->update(
                [
                    'title' => $request->input('title_post'),
                    'thumbnail' => $thumbnail,
                    'content' => $request->input('content_post'),
                    'user_id' => Auth::id(),
                    'cat_id' => $request->input('cat_post'),
                    'status' => $request->input('status'),
                    'slug'  => Str::slug($request->input('title_post')),
                ]
            );
            return redirect('admin/post/list')->with('status', 'Bạn đã cập nhật thành công');
        }      
    }
    // xóa
    function delete($id){
        $this->authorize('delete_post');
        Post::find($id)->delete();
        return redirect('admin/post/list')->with('status', 'Bản ghi đã xóa tạm thời');
    }
    // xóa vĩnh viễn
    function forcedelete($id){
        $this->authorize('delete_post');
        Post::withTrashed()
                    ->whereIn('id',$id)
                    ->forceDelete();
        return redirect('admin/post/list')->with('status','Bản ghi đã xóa vĩnh viễn!');
    }
    // xử lý nhiều bản ghi 1 lúc
    function action(Request $request){
        $list_check=$request->input('list_check');
        if(!empty($list_check)){
            $act=$request->input('act');
            if($act=='open'){
                foreach($list_check as $id){
                    if(Post::where('id', $id) && Post::where('status', "Công khai")){
                        unset($list_check[$id]);
                    }
                    Post::where('id', $id)->update(
                        [                
                            'status' => "Công khai",        
                        ]
                      );
                } 
                return redirect('admin/post/list')->with('status', 'Trạng thái được chuyển thành công');      
            }
            if($act=='wait'){
                foreach($list_check as $id){
                    if(Post::where('id', $id) && Post::where('status', "Chờ duyệt")){
                        unset($list_check[$id]);
                    }
                    Post::where('id', $id)->update(
                        [                
                            'status' => "Chờ duyệt",        
                        ]
                      );
                } 
                return redirect('admin/post/list')->with('status', 'Trạng thái được chuyển thành công');      
            }
            if($act=='delete'){ 
                $this->authorize('delete_post');              
                    Post::destroy($list_check);
                    return redirect('admin/post/list')->with('status', 'Bản ghi đã đưa vào thùng rác');     
                }
            if($act=='forcedelete'){   
                $this->authorize('delete_post');            
                    Post::withTrashed()
                    ->whereIn('id',$list_check)
                    ->forceDelete();
                    return redirect('admin/post/list')->with('status', 'Bản ghi đã xóa vĩnh viễn');     
                }  
            if($act=='restore'){               
                    Post::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                    return redirect('admin/post/list')->with('status', 'Bạn đã khôi phục thành công');     
            }
            if($act =='start'){
                return redirect('admin/post/list')->with('status', 'Bạn cần chọn tác vụ để thực hiện');
             }
        }
        else
        {
            return redirect('admin/post/list')->with('status', 'Bạn cần chọn phần tử để thực hiện');
        }
    }
}
