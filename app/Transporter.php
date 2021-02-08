<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transporter extends Model
{
    public function shippings()
    {
        return $this->hasMany(Shipping::class);
    }
}
