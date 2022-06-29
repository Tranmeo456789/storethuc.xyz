<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tinhthanhpho extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'matp', 'name_tinh','type'
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
