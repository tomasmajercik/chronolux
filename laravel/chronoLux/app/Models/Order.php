<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'address_id', 'email', 'total_price', 'delivery_price', 'delivery_method', 'status'];
    public $timestamps = false;

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
