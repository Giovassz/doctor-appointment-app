<x-mail::message>
# Hola {{ $appointment->patient->first_name }},

Su cita médica ha sido confirmada con éxito.

**Fecha:** {{ $appointment->date->format('d/m/Y') }}
**Hora:** {{ $appointment->start_time }}
**Doctor:** {{ $appointment->doctor->user->name }}

Se ha adjuntado a este correo un comprobante en formato PDF.

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
