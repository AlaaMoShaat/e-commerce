<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasTranslations;
    public $timestamps = false;
    public $translatable = ['name'];
    protected $fillable = ['name', 'phone_code', 'iso_code', 'status'];

    public function users() {
        return $this->hasMany(User::class, 'country_id');
    }
    public function governorates()
    {
        return $this->hasMany(Governorate::class, 'country_id');
    }

    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'active' : 'inactive';
    }
}