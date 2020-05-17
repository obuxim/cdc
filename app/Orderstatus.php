<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderstatus extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
