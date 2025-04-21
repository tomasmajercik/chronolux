<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'address_id', 'email', 'total_price', 'delivery_price', 'delivery_method', 'status'];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public $timestamps = false;

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
  
     public function orderItems()
    {
        return $this->hasMany(orderItem::class);
    }
}
