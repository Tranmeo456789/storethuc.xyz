<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class Tinhthanhpho extends Model
{
    protected $fillable = [
        'matp','name','type'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tinhthanhphos';
}
