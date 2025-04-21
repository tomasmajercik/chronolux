<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'email',
        'name',
        'phone_number',            
        'surname',       
        'total_price',
        'delivery_price',
        'delivery_method',
        'status',
        'created_at',
        'updated_at',
    ];
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

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

}
