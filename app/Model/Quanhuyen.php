<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class Quanhuyen extends Model
{
    protected $fillable = [
        'maqh','name','type','matp'
    ];
    protected $primaryKey = 'xaid';
    protected $table = 'quanhuyens';
}
