<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atribute extends Model
{
    public function variations()
    {
        return $this->hasMany(Variation::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
