<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xaphuongthitran extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'xaid', 'name_xa','type','maqh'
    ];

    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
