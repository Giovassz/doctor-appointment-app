<x-mail::message>
# Tu Agenda del Día - {{ $reportDate }}

Hola Médico,

Este es el resumen de tus pacientes programados para el día de hoy:

@if($appointments->count() > 0)
<x-mail::table>
| Hora | Paciente | Motivo |
|:-----|:---------|:-------|
@foreach($appointments as $appointment)
| {{ $appointment->start_time }} | {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }} | {{ Str::limit($appointment->reason ?? 'No especificado', 30) }} |
@endforeach
</x-mail::table>

**Total de citas hoy:** {{ $appointments->count() }}
@else
¡Hoy tienes el día libre! No hay pacientes agendados.
@endif

Por favor, revisa el sistema para ver los historiales completos.

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
