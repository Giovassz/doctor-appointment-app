<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendDailyAppointmentReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-daily-appointment-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía un reporte diario al administrador con las citas de hoy.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now()->format('Y-m-d');
        
        $appointments = \App\Models\Appointment::with(['patient', 'doctor.user'])
                            ->whereDate('date', $today)
                            ->orderBy('start_time')
                            ->get();

        // 1. Enviar el reporte global al Administrador
        $adminEmail = env('ADMIN_EMAIL', 'admin@example.com');
        \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\DailyAppointmentReport($appointments, $today));
        $this->info("Reporte global diario enviado a {$adminEmail} con {$appointments->count()} citas.");

        // 2. Enviar la agenda específica a cada Doctor
        $groupedByDoctor = $appointments->groupBy('doctor_id');

        foreach ($groupedByDoctor as $doctorId => $doctorAppointments) {
            $doctorUser = $doctorAppointments->first()->doctor->user ?? null;
            
            if ($doctorUser && $doctorUser->email) {
                \Illuminate\Support\Facades\Mail::to($doctorUser->email)
                    ->send(new \App\Mail\DoctorDailySchedule($doctorAppointments, $today));
                    
                $this->info("Agenda enviada al Doctor {$doctorUser->name} ({$doctorUser->email}) con {$doctorAppointments->count()} pacientes.");
            }
        }
    }
}
