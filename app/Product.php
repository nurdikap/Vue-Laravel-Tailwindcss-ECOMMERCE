<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function atributes()
    {
        return $this->belongsToMany(Atribute::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
