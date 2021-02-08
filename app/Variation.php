<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function atribute()
    {
        return $this->belongsTo(Atribute::class);
    }
}
