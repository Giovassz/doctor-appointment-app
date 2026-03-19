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

        $adminEmail = env('ADMIN_EMAIL', 'admin@example.com');
        
        \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\DailyAppointmentReport($appointments, $today));
        
        $this->info("Reporte diario enviado a {$adminEmail} con {$appointments->count()} citas.");
    }
}
