<x-mail::message>
# Reporte Diario de Citas - {{ $reportDate }}

Hola Administrador,

Aquí tienes el resumen de las citas programadas para el día de hoy:

@if($appointments->count() > 0)
<x-mail::table>
| Hora | Paciente | Médico | Motivo |
|:-----|:---------|:-------|:-------|
@foreach($appointments as $appointment)
| {{ $appointment->start_time }} | {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }} | {{ $appointment->doctor->user->name }} | {{ Str::limit($appointment->reason ?? 'N/A', 20) }} |
@endforeach
</x-mail::table>

**Total de citas hoy:** {{ $appointments->count() }}
@else
No hay citas programadas para el día de hoy.
@endif

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
