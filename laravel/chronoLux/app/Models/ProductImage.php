<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'products_images';
    public $timestamps = false;

    protected $fillable = ['product_id', 'image_path', 'is_cover'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
