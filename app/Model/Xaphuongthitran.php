<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class Xaphuongthitran extends Model
{
    protected $fillable = [
        'xaid','name','type','maqh'
    ];
    protected $primaryKey = 'xaid';
    protected $table = 'xaphuongthitrans';
}
