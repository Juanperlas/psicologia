<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Cita</title>
    <style>
        body {
            width: 302px;
            height: 100%;
            margin: auto;
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }

        @media print {
            @page { margin: 0; }
            body { margin: 1.6cm; }
        }

        h1 {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: bold;
            color: @if ($otrosDatos['estado'] == 'Pendiente') #007BFF @elseif ($otrosDatos['estado'] == 'Aceptado') #28A745 @elseif ($otrosDatos['estado'] == 'Rechazado') #DC3545 @endif;
        }

        p {
            margin: 5px 0;
        }

        hr {
            border: none;
            border-top: 1px solid #000;
            margin: 10px 0;
        }

        .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .column {
            width: 48%;
            text-align: left;
        }
        .column2 {
            width: 48%;
            text-align: right;
        }
        .column3 {
            width: 48%;
            text-align: center;
        }
        .label {
            font-weight: bold;
        }

        .logo {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .total {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }

        .total span {
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">
    <img src="{{ asset('plogo2.png') }}" alt="Logo" class="logo">
    <hr />
    <h1>Comprobante de Cita {{ $otrosDatos['estado'] }}</h1>
    <hr>
    <div class="details">
        <div class="column">
            <p><span class="label">ID:</span></p>
            <p><span class="label">Usuario:</span></p>
            <p><span class="label">Fecha de Reserva:</span></p>
            <p><span class="label">Hora de Reserva:</span></p>
            <p><span class="label">Hora Fin Reserva:</span></p>
        </div>
        <div class="column2">
            <p>{{ $citaPendiente->id }}</p>
            <p>{{ $citaPendiente->usuario['name'] }}</p>
            <p>{{ \Carbon\Carbon::parse($citaPendiente->fecha)->format('M, d Y') }}</p>
            <p>{{ \Carbon\Carbon::parse($citaPendiente->hora)->format('H:i:s') }}</p>
            <p>{{ \Carbon\Carbon::parse($citaPendiente->hora_fin)->format('H:i:s') }}</p>
        </div>
    </div>

    <!-- Información de la fecha y hora actuales -->
    <div class="details">
        <div class="column3">
            <p><span class="label">Fecha Actual:<br></span> {{ $otrosDatos['fechaActual'] }}</p>
        </div>
        <div class="column3">
            <p><span class="label">Hora Actual:<br></span> {{ $otrosDatos['horaActual'] }}</p>
        </div>
    </div>

    <hr>

    <!-- Otros datos que hayas pasado -->
    <!-- ... -->

    <div class="total">
        <span>Total:</span>
        <span>S/. {{ number_format(optional($citaPendiente)->importe, 2) }}</span>
    </div>
</body>
</html>
