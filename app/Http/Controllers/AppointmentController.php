<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Lawyer;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lawyer_id' => 'required|exists:lawyers,id',
            'user_id' => 'required|exists:users,id',
            'dateTime' => 'required|date',
        ]);

        $lawyer = Lawyer::findOrFail($validated['lawyer_id']);
        $address = $lawyer->address;

        Appointment::create([
            'lawyer_id' => $validated['lawyer_id'],
            'user_id' => $validated['user_id'],
            'dateTime' => $validated['dateTime'],
            'address' => $address,
            'status' => 'Pending',
            'rating' => null,
            'review' => null,
        ]);

        return redirect()->route('getLawyer', ['id' => $request->lawyer_id])
            ->with('success', 'Appointment booked successfully!');
    }

    // Function buat nanti si lawyer bisa ubah status Pending -> Confirm
    // Route::post('/appointments/confirm/{appointment_id}', [AppointmentController::class, 'confirmAppointment'])->name('appointments.confirm');
    public function confirmAppointment($appointment_id)
    {
        $appointment = Appointment::findOrFail($appointment_id);

        // Update status to "Confirmed"
        $appointment->status = 'Confirmed';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment confirmed!');
    }
}
