<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    protected $fillable = ['name'];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public static function getCached()
    {
        return \Illuminate\Support\Facades\Cache::remember('blood_types_all', 3600, function () {
            return self::all();
        });
    }
}
