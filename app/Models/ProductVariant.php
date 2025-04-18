<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'price',
        'stock'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function variantAttributes() {
        return $this->hasMany(VariantAttribute::class);
    }


}
