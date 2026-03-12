<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $fillable = ['name'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public static function getCached()
    {
        return \Illuminate\Support\Facades\Cache::remember('specialities_all', 3600, function () {
            return self::orderBy('name')->get();
        });
    }
}
