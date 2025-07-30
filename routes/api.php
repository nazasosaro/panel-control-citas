<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\AppointmentConfirmationMail;
use App\Mail\AppointmentCancellationMail;

Route::post('/appointments', function (Request $request) {
    $data = $request->validate([
        'patient' => 'required|string',
        'date' => 'required|date',
        'time' => 'required',
    ]);

    $content = "Hola {$data['patient']}, tu cita ha sido confirmada para el día {$data['date']} a las {$data['time']}.";

    Mail::to('cliente@email.com')->send(new AppointmentConfirmationMail('cliente@email.com', 'Confirmación de Cita', $content));

    return response()->json(['message' => 'Correo enviado']);
});

Route::post('/appointments/cancel', function (Request $request) {
    $data = $request->validate([
        'patient' => 'required|string',
        'date' => 'required|date',
        'time' => 'required',
    ]);

    $content = "Hola {$data['patient']}, tu cita del día {$data['date']} a las {$data['time']} ha sido cancelada.";

    Mail::to('cliente@email.com')->send(new AppointmentCancellationMail('cliente@email.com', 'Cancelación de Cita', $content));

    return response()->json(['message' => 'Correo de cancelación enviado']);
});
