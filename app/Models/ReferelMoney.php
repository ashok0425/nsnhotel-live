<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferelMoney extends Model
{
    protected $table = 'referels_money';

     public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
