<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'discount_percentage', 'start_date', 'end_date', 'limit', 'times_used','status'];

    public function getCreatedAtAttribute($val)
    {
        return date('Y/m/d - H:i A', strtotime($val));
    }

    public function getUpdatedAtAttribute($val)
    {
        return date('Y/m/d - H:i A', strtotime($val));
    }

    public function scopeValid($query) {
        return $query->where('status', 1)
            ->where('end_date', '>', now())
            ->where('limit', '>', 'times_used');
    }

    public function scopeInValid($query) {
        return $query->where('status', 0)
            ->orWhere('end_date', '<', now())
            ->orWhere('limit', '<=', 'times_used');
    }

    public function scopeIsValid() {
        return $this->status == 1 && $this->limit > $this->times_used && $this->end_data > now();
    }

    public function getStatusTranslatable()
    {
        if( app()->getLocale() == 'ar') {
            return $this->status == 1? 'مفعل' : 'غير مفعل';
        }else {
            return $this->status == 1? 'Active' : 'Inactive';
        }
    }
}