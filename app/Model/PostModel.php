<?php

namespace App\Model;
use Session;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\BackEndModel;
use Illuminate\Support\Str;
use DB;
class PostModel extends BackEndModel
{
   // protected $casts = [];
    public function __construct()
    {
        $this->table               = 'post';
        $this->controllerName      = 'post';
        $this->folderUpload        = 'post';
        $this->crudNotAccepted     = ['_token', 'btn_save','file-del','file'];
    }
   
    // public function scopeOfUser($query)
    // {
    //     if (\Session::has('user')){
    //         $user = \Session::get('user');
    //         if($user['is_admin']==1 || $user['is_admin']==2){
    //             return  $query;
    //         }else{
    //             return  $query->where('user_id',$user->user_id);
    //         }      
    //     }
    //     return $query;
    // }
    public function listItems($params = null, $options = null)
    {
        $result = null;
       // $user = Session::get('user');
        if ($options['task'] == "user-list-items") {
            $query = $this->select('id','name','thumbnail','content','status_post','slug','cat_id','user_id','created_at', 'updated_at')->where('id','>=',1);
            
            if ((isset($params['filter']['status_post'])) && ($params['filter']['status_post'] != 'all')) {
                $query = $query->where('status_post',$params['filter']['status_post']);
            }
            //$query->orderBy('created_at', 'desc');
            if (isset($params['pagination']['totalItemsPerPage'])){
                $result =  $query->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $result = $query->get();
            }

        }

        if ($options['task'] == 'user-list-all-items'){
            $result = $this::selectRaw("id as page_id")
                                    ->where('id','>',1)
                                    ->ofUser()
                                    ->get()
                                    ->toArray();
        }
        if ($options['task'] == "get-list-items-of-one-cat") {
            $query = $this::select('id','name','thumbnail','content','status_post','slug','cat_id','user_id','created_at', 'updated_at')
                                ->where('id','>=',1)->where('status_post','cong_khai');
            if (isset($params['cat_id'])){
                $query->where('cat_id', $params['cat_id']);
            }
            if(isset($params['limit'])){
                $result=$query->paginate($params['limit']);
            }else{
                $result =  $query->get();
            }
            
        }
       
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')
                        ->where('id','>',1)
                        ->OfUser()
                        ->orderBy('name', 'asc');
            $result = $query->pluck('name', 'id')->toArray();
        }
       
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','name','thumbnail','content','status_post','slug','cat_id','user_id','created_at', 'updated_at')
                            ->where('id', $params['id'])
                            ->first();
        }
        if ($options['task'] == 'get-item-in-slug') {
            $result = self::select('id','name','thumbnail','content','status_post','slug','cat_id','user_id','created_at', 'updated_at')
                            ->where('slug', $params['slug'])
                            ->first();
        }
      
        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'add-item') {
             $this->setCreatedHistory($params);
             self::insert($this->prepareParams($params));
        }
        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            $item = self::getItem($params,['task'=>'get-item']);
            
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
        if($options['task'] == 'update-status-item-of-admin'){
            self::where('id', $params['id'])->update(['status_post' => $params['status_post']]);
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
    public function countItems($params = null, $options  = null) {

        $result = null;
        if($options['task'] == 'admin-count-items-group-by-user-id') {
            $query = $this::groupBy('user_id')
                            ->select(DB::raw('user_id , COUNT(id) as count'))
                            ->where('id','>',1)->where('user_id',$params['user_id']);
            if(isset($params['filter_in_day'])){
                $query->whereBetween('created_at', ["{$params['filter_in_day']['day_start']}", "{$params['filter_in_day']['day_end']}"]);
            }
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'admin-count-items-group-by-status-page') {
            $query = $this::groupBy('status_post')
                            ->select(DB::raw('status_post , COUNT(id) as count') )
                            ->where('id','>=',1);
            
            $result = $query->get()->toArray();
        }
       
        return $result;
    }
    public function catPost(){
        return $this->belongsTo('App\Model\CatPostModel','cat_id','id');
    }
    public function userPost(){
        return $this->belongsTo('App\Model\UserModel','user_id','id');
    }
}
