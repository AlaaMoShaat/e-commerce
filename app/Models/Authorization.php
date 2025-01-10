<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Authorization extends Model
{
    protected $guarded = [];
    use HasTranslations;

    public $translatable = ['role'];

    public function getPermessionAttribute($permessions) // اكسيسوريز برجع البيرمشنز ك اريه لما اجي استدعيها
    {
        return json_decode($permessions);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'role_id');
    }
}
