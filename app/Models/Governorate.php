<?php

namespace App\Models;

use App\Models\ShippingGovernorate;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Governorate extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = ['name', 'status', 'country_id'];
    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'governorate_id');
    }

    public function shippingGovernorate() {
        return $this->hasOne(ShippingGovernorate::class, 'governorate_id');
    }

    public function users() {
        return $this->hasMany(User::class, 'governorate_id');
    }

    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'active' : 'inactive';
    }
}