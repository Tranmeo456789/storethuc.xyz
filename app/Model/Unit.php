<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Unit extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $units = [
        'email_verified_at' => 'datetime',
    ];
}
