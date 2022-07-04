<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
       protected $fillable = [
        'name',
        'symbol',
        'fee',
    ];
    protected $table='currencies';
    
   

}
