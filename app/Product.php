<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model

{
    protected $guarded = [];
 
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

 
}
