<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function coverImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_cover', true);
    }
        public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
