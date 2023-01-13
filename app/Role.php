<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','display_name'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    function users(){
        return $this->belongsToMany('App\Model\UserModel');
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class,"permission_role","role_id","permission_id");
    }
    public function listItems($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == "admin-list-items-in-selectbox") {
            $query = self::select('id', 'display_name');
            $result = $query->orderBy('display_name', 'asc')
            ->pluck('display_name', 'id')->toArray();
        }

        return $result;
    }
}
