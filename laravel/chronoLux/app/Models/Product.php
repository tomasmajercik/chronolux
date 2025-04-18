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
        return $this->hasMany(ProductImage::class)->where('is_cover', false);
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
