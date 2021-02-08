<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function variations()
    {
        return $this->belongsToMany(Variation::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
