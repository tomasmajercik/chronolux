<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->postal_code} {$this->city}, {$this->country}";
    }
}
