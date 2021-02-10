<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function attributes(){
        return $this->belongsToMany(Attribute::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class);

    }
}
