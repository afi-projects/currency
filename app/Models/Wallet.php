<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
       protected $fillable = [
        'address',
        'user_id',
        'balance',
    ];
    protected $table='wallets';
    
        public function user()
    {
        return $this->belongsTo(User::class);
    }

}
