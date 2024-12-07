<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Lawyer;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lawyer_id' => 'required|exists:lawyers,id',
            'user_id' => 'required|exists:users,id',
            'dateTime' => 'required|date|after_or_equal:tomorrow',
        ], [
            'dateTime.after_or_equal' => 'Appointments can only be scheduled starting from tomorrow onward.',
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

    public function getUserAppointments()
    {
        $appointments = Appointment::with('lawyer')
            ->where('user_id', auth()->id())
            ->get();

        return view('userAppointments', compact('appointments'));
    }

    public function getLawyerAppointments()
    {
        $lawyerId = Auth::guard('lawyer')->id();

        $appointments = Appointment::with('user')
            ->where('lawyer_id', $lawyerId)
            ->get();

        return view('lawyer/lawyerAppointments', compact('appointments'));
    }

    public function updateAppointmentStatus($userId, $lawyerId, $newStatus)
    {
        Appointment::where('lawyer_id', $lawyerId)
            ->where('user_id', $userId)
            ->update(['status' => $newStatus]);

        $appointments = Appointment::where('lawyer_id', $lawyerId)->get();

        return view('lawyer/lawyerAppointments', compact('appointments'));
    }

    public function updateRatingReview($userId, $lawyerId, Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        Appointment::where('lawyer_id', $lawyerId)
            ->where('user_id', $userId)
            ->where('status', "Completed")
            ->update([
                'rating' => $validated['rating'],
                'review' => $validated['review']
            ]);

        $appointments = Appointment::where('lawyer_id', $lawyerId)->get();

        return redirect()->back()->with('success', 'Thank you for your review!');
    }



}
