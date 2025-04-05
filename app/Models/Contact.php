<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['id', 'name', 'email', 'phone', 'subject', 'message', 'user_id'];

    public function scopeRead($query) {
        return $query->where('is_read', 1);
    }

    public function scopeUnRead($query) {
        return $query->where('is_read', 0);
    }

    public function scopeAnswered($query) {
        return $query->where('reply_status',1);
    }

    public function scopeUnanswered($query) {
        return $query->where('reply_status',0);
    }

    public static function searchContact($keyword) {
        return self::when($keyword, function($query) use ($keyword) {
            $query->where('email', 'like', '%'. $keyword .'%');
        });
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
