<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function governorate() {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }
    public function city() {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function getCreatedAtAttribute($val)
    {
        return date('Y/m/d - H:i A', strtotime($val));
    }

    public function getEmailVerifiedAtAttribute($val)
    {
        return date('Y/m/d - H:i A', strtotime($val));
    }

    public function getStatusTranslatable()
    {
        return $this->status == 1? __('static.status.active') : __('static.status.inactive');
    }
}