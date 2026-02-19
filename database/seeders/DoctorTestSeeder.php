<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Database\Seeder;

class DoctorTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'doctor@test.com'],
            [
                'name' => 'Dr. Test User',
                'id_number' => '1234567890',
                'password' => bcrypt('password'),
            ]
        );

        $user->assignRole('Administrador'); // Or a Doctor role if it exists

        $speciality = Speciality::first();

        Doctor::updateOrCreate(
            ['user_id' => $user->id],
            [
                'speciality_id' => $speciality->id ?? null,
                'medical_license_number' => '12345678',
                'biography' => 'Esta es una biografía de prueba para el Dr. Test.',
            ]
        );
    }
}
