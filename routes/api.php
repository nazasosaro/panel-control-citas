<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\AppointmentConfirmationMail;

Route::post('/appointments', function (Request $request) {
    $data = $request->validate([
        'patient' => 'required|string',
        'date' => 'required|date',
        'time' => 'required',
    ]);

    $content = "Hola {$data['patient']}, tu cita ha sido confirmada para el día {$data['date']} a las {$data['time']}.";

    Mail::to($data['email'])->send(new AppointmentConfirmationMail($data['email'], 'Confirmación de Cita', $content));

    return response()->json(['message' => 'Correo enviado']);
});
