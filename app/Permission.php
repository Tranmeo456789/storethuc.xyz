<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','display_name','parrent_id'
    ];

    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // function users(){
    //     return $this->belongsToMany('App\User');
    // }
    public function PermissionsChildrent(){
        return $this->hasMany(Permission::class,'parrent_id');

    }
}
