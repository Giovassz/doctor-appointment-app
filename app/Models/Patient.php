<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'allergies',
        'blood_type_id',
        'emergency_contact_name',
        'emergency_contact_phone',
    ];

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }

}
