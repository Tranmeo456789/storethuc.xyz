<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    public $timestamps = false;
    protected $fillable = [ 'provider_user_id','provider','user'];
    protected $primaryKey = 'user_id';
    protected $table = 'tbl_socials';
    public function login(){
    return $this->belongsTo('App\User','users');
}

}
