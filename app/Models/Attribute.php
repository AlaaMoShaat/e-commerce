<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasTranslations;
    protected $fillable = ['id', 'name', 'created_at', 'updated_at'];
    public $translatable = ["name"];

    public function attributeValues() {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }

    public function getCreatedAtAttribute($val)
    {
        return date('Y/m/d - H:i A', strtotime($val));
    }
}