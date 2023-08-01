<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use App\Role;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status_user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    function roles(){
        return $this->belongsToMany('App\Role');
    }
    // function roles(){
    //     return $this->belongsToMany(related: Role::class, table: 'role_user', foreignPivotKey: 'user_id', relatedPivotKey: 'role_id');
    // }
    public function roles1(){
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
    }
    public function checkPermissionAccess($permissionCheck){
        $roles=auth()->user()->roles;
        foreach($roles as $role){
            $permissions=$role->permissions;
            if($permissions->contains('key_code',$permissionCheck)){
                return true;
            }
        }
        return false;
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
