<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function atribute()
    {
        return $this->belongsTo(Atribute::class);
    }
}
