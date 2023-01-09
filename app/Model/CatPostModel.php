<?php

namespace App\Model;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\BackEndModel;
use Illuminate\Support\Str;
use App\Model\PostModel;
use DB;
class CatPostModel extends BackEndModel
{
    protected $table  = 'cat_post';
    protected $guarded = [];

    public function listItems($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == "admin-list-items") {
            $query = $this::select('id', 'name','slug','parent_id', 'created_at', 'updated_at');
            $query=$query->where('parent_id',1);
            $result =  $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);
        }
        if ($options['task'] == "list-items-front-end") {
            $query = $this::select('id', 'name','slug','parent_id', 'created_at', 'updated_at');
            $query=$query->where('parent_id',1)->orderBy('id', 'asc')->get();
            $result = $query;
        }
        
        if ($options['task'] == "admin-list-items-in-selectbox") {
            $query = self::select('id', 'name')
                ->where('parent_id', 1);
            $result = $query->orderBy('name', 'asc')
            ->pluck('name', 'id')->toArray();
        }

        return $result;
    }
    public function countItems($params = null, $options  = null)
    {
        $result = null;
        if ($options['task'] == 'admin-count-items-group-by-status') {
            $query = $this::groupBy('status')
                ->select(DB::raw('status , COUNT(id) as count'))
                ->where('id', '<>', 1);

            $result = $query->get()->toArray();
        }
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name','slug','parent_id', 'created_at', 'updated_at')
                ->where('id', $params['id'])->first();
        }
        if ($options['task'] == 'get-item-parent') {
            $result = self::select('id', 'name','slug','parent_id', 'created_at', 'updated_at')->where('id', $params['parent_id'])->first();
            if(isset($params['up_level'])){
                $catParent=$result;
                for ($i = 1; $i < $params['up_level']; $i++){
                     $catParent = self::getParent($catParent['parent_id']);
                }
                $result=$catParent; 
            }                   
        }
        if ($options['task'] == 'get-item-slug') {
            $result = self::select('id', 'name','slug','parent_id', 'created_at', 'updated_at')
                ->where('slug', $params['slug'])->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        $image = '';

        if ($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            $params['slug'] =  Str::slug($params['name']);
            $params['parent_id'] =  1;
            $params['status'] =  'active';
            self::create($this->prepareParams($params));
        }

        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            $params['slug'] =  Str::slug($params['name']);
            $params['parent_id'] =  1;
            $params['status'] =  'active';
            //$params['updated_by'] = \Session::get('user')['user_id'];
            //$parent = self::find($params['parent_id']);
            $query = $current = self::find($params['id']);
            $query->update($this->prepareParams($params));
            //if ($current->parent_id != $params['parent_id']) $query->prependToNode($params)->save();
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }
    public function move($params = null, $options = null)
    {
        $this->setModifiedHistory($params);
        $params['updated_by'] = \Session::get('user')['user_id'];
        $node = self::find($params['id']);
        self::where('id', $params['id'])
            ->update(
                [
                    'updated_at' => $params['updated_at'],
                    'updated_by' => $params['updated_by']
                ]
            );
        if ($params['type'] == 'down') $node->down();
        if ($params['type'] == 'up') $node->up();
    }
    public static function getChild($id='')
    {
        $item = self::find($id);
        $query = self::select('id','name');

        return $result = $query->pluck('id')->toArray();
    }
    public static function getParent($parent_id='')
    {
        $item = self::where('id', $parent_id)->first();
        return $item;
    }
    public function postsOfChild()
    {
        return $this->hasMany('App\Model\PostModel','cat_post_parent_id');
    }
}
