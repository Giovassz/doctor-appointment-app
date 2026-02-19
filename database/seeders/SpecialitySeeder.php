<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialities = [
            'Cardiología',
            'Pediatría',
            'Dermatología',
            'Ginecología',
            'Neurología',
            'Oftalmología',
            'Traumatología',
            'Medicina General',
        ];

        foreach ($specialities as $name) {
            Speciality::create(['name' => $name]);
        }
    }
}
