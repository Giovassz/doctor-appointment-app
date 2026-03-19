<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendDoctorSchedules extends Command
{
    protected $signature = 'app:send-doctor-schedules';
    protected $description = 'Envía la agenda del día a cada Doctor con sus pacientes agendados.';

    public function handle()
    {
        $today = now()->format('Y-m-d');

        $appointments = \App\Models\Appointment::with(['patient', 'doctor.user'])
                            ->whereDate('date', $today)
                            ->orderBy('start_time')
                            ->get();

        if ($appointments->isEmpty()) {
            $this->info('No hay citas para hoy. No se envió ningún correo.');
            return;
        }

        $groupedByDoctor = $appointments->groupBy('doctor_id');
        $doctorDemoEmail = env('DOCTOR_DEMO_EMAIL', 'giovas.lizama@gmail.com');

        foreach ($groupedByDoctor as $doctorId => $doctorAppointments) {
            $doctorUser = $doctorAppointments->first()->doctor->user ?? null;
            $doctorName = $doctorUser ? $doctorUser->name : 'Doctor';

            \Illuminate\Support\Facades\Mail::to($doctorDemoEmail)
                ->send(new \App\Mail\DoctorDailySchedule($doctorAppointments, $today));

            $this->info("Agenda enviada al Dr. {$doctorName} → {$doctorDemoEmail} ({$doctorAppointments->count()} pacientes).");
        }
    }
}
