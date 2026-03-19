<!DOCTYPE html>
<html>
<head>
    <title>Comprobante de Cita Médica</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #3b82f6; padding-bottom: 20px; }
        .details { margin-top: 30px; }
        .details th { text-align: left; padding: 8px; border-bottom: 1px solid #ddd; }
        .details td { padding: 8px; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Comprobante de Cita Médica</h1>
        <p>{{ config('app.name') }}</p>
    </div>

    <div class="details">
        <h3>Datos del Paciente</h3>
        <p><strong>Nombre:</strong> {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</p>
        <p><strong>Email:</strong> {{ $appointment->patient->email }}</p>

        <h3>Detalles de la Cita</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <th>Médico</th>
                <td>{{ $appointment->doctor->user->name }}</td>
            </tr>
            <tr>
                <th>Fecha</th>
                <td>{{ $appointment->date->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Hora</th>
                <td>{{ $appointment->start_time }} - {{ $appointment->end_time }}</td>
            </tr>
            <tr>
                <th>Motivo</th>
                <td>{{ $appointment->reason ?? 'No especificado' }}</td>
            </tr>
        </table>
    </div>

</body>
</html>
