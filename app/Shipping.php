<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public function transporter()
    {
        return $this->belongsTo(Transporter::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
