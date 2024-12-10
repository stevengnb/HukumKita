<?php

namespace App\Http\Controllers;

use App\Models\Expertise;
use App\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LawyerController extends Controller
{
    public function getLawyers(Request $req) {
        $query = Lawyer::with('expertises');

        if ($req->has('price_range') && $req->input('price_range') !== '') {
            if ($req->input('price_range') == '1-3') {
                $query->whereBetween('rate', [1, 3]);
            } elseif ($req->input('price_range') == '4-5') {
                $query->whereBetween('rate', [4, 5]);
            }
        }

        if ($req->has('expertise')) {
            if (!($req->input('expertise') == '')) {
                $query->whereHas('expertises', function ($q) use ($req) {
                    $q->where('id', $req->input('expertise'));
                });
            }
        }

        if ($req->has('search') && $req->input('search') !== '') {
            $query->where('name', 'like', '%'.$req->input('search').'%');
        }

        $lawyers = $query->paginate(8);

        foreach ($lawyers as $lawyer) {
            $completedAppointments = $lawyer->appointments->filter(function ($appointment) {
                return !is_null($appointment->rating) && !is_null($appointment->review);
            });

            $lawyer->appointments_total_ratings = $completedAppointments->count();
            $lawyer->appointments_avg_rating = $completedAppointments->avg('rating') ?: 0;
            $lawyer->exp_years = number_format(abs(Carbon::now()->diffInYears($lawyer->experience)), 0);
            $lawyer->expertise_names = $lawyer->expertises->pluck('name')->toArray();

            $lawyer->user_appointment_status = null;
            if (Auth::check()) {
                $userAppointment = $lawyer->appointments->where('user_id', auth()->user()->id)->first();
                $lawyer->user_appointment_status = $userAppointment ? $userAppointment->status : null;
            }
        }

        $expertises = Expertise::all();

        return view('lawyers', compact('lawyers', 'expertises'));
    }

    public function getLawyer($id) {
        $lawyer = Lawyer::with(['expertises', 'appointments'])->find($id);
        $lawyer->expertise_names = $lawyer->expertises->pluck('name')->toArray();
        $lawyer->exp_years = number_format(abs(Carbon::now()->diffInYears($lawyer->experience)), 0);

        $completedAppointments = $lawyer->appointments->filter(function ($appointment) {
            return !is_null($appointment->rating) && !is_null($appointment->review);
        });

        $lawyer->appointments_total_ratings = $completedAppointments->count();
        $lawyer->appointments_avg_rating = $completedAppointments->avg('rating') ?: 0;

        $lawyer->user_appointment_status = null;

        if (Auth::check()) {
            $userAppointment = $lawyer->appointments->where('user_id', auth()->user()->id)->first();
            $lawyer->user_appointment_status = $userAppointment ? $userAppointment->status : null;
        }

        return view('lawyerDetail', compact('lawyer', 'completedAppointments'));
    }

    public function getLawyerBookingPage($id) {
        $lawyer = Lawyer::with(['expertises', 'appointments'])->find($id);
        $lawyer->expertise_names = $lawyer->expertises->pluck('name')->toArray();
        $lawyer->exp_years = number_format(abs(Carbon::now()->diffInYears($lawyer->experience)), 0);

        return view('bookAppointment', compact('lawyer'));
    }
}
