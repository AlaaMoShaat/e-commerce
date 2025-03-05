<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['name', 'desc', 'small_desc'];
    protected $fillable = [
        'name',
        'small_desc',
        'desc',
        'status',
        'sku',
        'available_for',
        'views',
        'has_variants',
        'price',
        'has_discount',
        'discount',
        'start_discount',
        'end_discount',
        'manage_stock',
        'quantity',
        'available_in_stock',
        'category_id',
        'brand_id'
    ];
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_items', 'product_id', 'order_id');
    }

    public function reviews() {
        return $this->hasMany(ProductPreview::class);
    }

    public function wishlist() {
        return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function isSimple() {
        return !$this->has_variants;
    }

    public function getCreatedAtAttribute($val)
    {
        return date('Y/m/d - H:i A', strtotime($val));
    }

    public function getUpdatedAtAttribute($val)
    {
        return date('Y/m/d - H:i A', strtotime($val));
    }
    public function getPriceAttribute($val)
    {
       return !$this->has_variants ? number_format($val,2) : __('static.products.has_variants');
    }
    public function getQuantityAttribute($val)
    {
        return !$this->has_variants ? $val : __('static.products.has_variants');
    }

    public function hasVariantsTranslated() {
        return $this->has_variants ? __('static.products.has_variants') : __('static.products.no_variants');
    }

    public function getStatusTranslatable()
    {
        return $this->status ? __('static.status.active') : __('static.status.inactive');
    }

    public function scopeActive($query) {
        return $query->where('status', 1);
    }
    public function scopeInactive($query) {
        return $query->where('status', 0);
    }
}