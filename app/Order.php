<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Order extends Model
{
    // Belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Has Status
    public function status()
    {
        return $this->belongsTo(Orderstatus::class);
    }
}
